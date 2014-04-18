<?php

class Skill extends BaseModel
{

    protected $guarded = [];

    protected $softDelete = false;

	protected $fillable = ['name', 'trampoline_difficulty', 'doublemini_difficulty', 'tumbling_difficulty', 'fig', 'flip_direction', 'occurrence'];

	public $timestamps = false;

    const REDIS_SKILL_NAME = 'skills:name:';
    const REDIS_SKILL_FIG  = 'skills:fig:';

    public static function validSkill($skill)
    {
        if (empty($skill)) return false;

        // First let's check if the skill exists as a written name in Redis for fast lookup
        if (Redis::hget(self::REDIS_SKILL_NAME . self::massageNameString($skill), '_id') !== null) {
            return true;
        
        // If it doesn't exist, check to see if the skill was an FIG shorthand instead of a name
        } else if (Redis::get(self::REDIS_SKILL_FIG . self::massageFigString($skill)) !== null) {
            return true;
        
        // If it still isn't found, check the Mongo database
        } else {

            // Search with more flexibility (like '>' for pike, without position for single flips)
            // TODO: Add more fuzzy searching
            return self::where('name', 'like', self::massageNameString($skill))
                ->orWhere('fig', '=', self::massageFigString($skill))
                ->count() > 0;
        }
    }

    public static function checkForErrors(array $skills)
    {
        return array_filter($skills, function($skill) { return self::invalidSkill($skill); });
    }

    public static function invalidSkill($skill)
    {
        return ! self::validSkill($skill);
    }

    public static function search($skill)
    {
        return static::where('name', self::massageNameString($skill))
            ->orWhere('fig', self::massageFigString($skill))
            ->first();
    }

    public function getTrampolineDifficultyAttribute($value) { return $this->formatDifficulty($value); }
    public function getDoubleminiDifficultyAttribute($value) { return $this->formatDifficulty($value); }
    public function getTumblingDifficultyAttribute($value)   { return $this->formatDifficulty($value); }

    public function formatDifficulty($value)
    {
        return sprintf("%0.1f", $value);
    }

    // public static function fuzzyFind($skillName, $exact = false)
    // {
    //     if ( ! $exact) {
    //         $skill = self::whereRaw([
    //             'name' => [
    //                 '$regex' => '^' . $skillName . '$',
    //                 '$options' => 'i',
    //             ]
    //         ])->orWhereRaw([
    //             'fig' => [
    //                 '$regex' => '^' . static::massageFigString($skillName) . '$',
    //                 '$options' => 'i',
    //             ]
    //         ])->first();
    //     }

    //     return $skill;

    //     /////////////////////////////////
    //     $skill = self::where(function($query) use($skillName) {
    //         if ($exact)
    //             $query->where('name', $skillName);
    //         else
    //             $query->where('name', 'like', '%' . $skillName . '%');
    //     })->orWhere('fig', $skillName);

    //     if (Input::has('limit')) {
    //         $skill->take((int) Input::get('limit'));
    //     }

    //     $skillResult = $skill->orderBy('occurrence')->get();

    //     return $skillResult;
    // }

    public static function massageNameString($nameString)
    {
        return $nameString;
    }

    public static function massageFigString($figString)
    {
        $figString = str_replace('>', '<', $figString);

        $figString = str_replace('O', 'o', $figString);

        $figString = str_replace('\\', '/', $figString);

        $newFigString = '';

        // Begin analyzing the string received
        for ($i = 0, $s = strlen($figString); $i < $s; ++$i) {

            $prev = (isset($figString[$i - 1])) ? $figString[$i - 1] : '';
            $cur = $figString[$i];
            $next = (isset($figString[$i + 1])) ? $figString[$i + 1] : '';

            $newFigString .= $cur;

            // If the current character is a number and the next character is a position (no space between), inject a space after the char
            if (is_numeric($cur) && in_array($next, ['<', 'o', '/'])) {
                $newFigString .= ' ';

            // If the current character is a number and is not proceeded by a dot or a space, inject a dot after the char.
            } else if (is_numeric($cur) && $next != '.' && $next != ' ') {

                // We need to check if the number is double digit first (ie 12 or 16)
                if ( ! ($cur == '1' && ($next == '2' || $next == '6'))) {
                    $newFigString .= '.';
                }
            }
        }

        return $newFigString;
    }

}
?>