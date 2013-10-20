<?php

use Way\Tests\Assert;
use Way\Tests\Should;

class PracticeTest extends TestCase {

    public function testHelloWorld()
    {
        $greeting = 'Hello, World.';

        Should::equal('Hello, World.', $greeting);
    }

    public function testLaravelDevsIncludesDayle()
    {
        $names = ['Taylor', 'Shawn', 'Dayle', 'Austin'];

        Should::contain('Austin', $names);
    }

    public function testFamilyRequiresParent()
    {
        $family = [
            'parents' => 'John',
            'children' => ['Timmy', 'Suzy']
        ];

        Assert::internalType('string', $family['parents']);
    }

    public function testStampMustBeInstanceOfDateTime()
    {
        $date = new DateTime();

        $this->assertInstanceOf('DateTime', $date);
    }

    public function testFetchesItemsInArrayUntilKey()
    {
        // Arrange
        $names = ['Taylor', 'Dayle', 'Matthew', 'Shawn', 'Neil'];

        // Act
        $result = array_until('Matthew', $names);

        // Assert
        $expected = ['Taylor', 'Dayle'];

        Should::equal($expected, $result);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testInvalidSearchInArrayUntilThrowsException()
    {
        // Arrange
        $names = ['Taylor', 'Dayle', 'Matthew', 'Shawn', 'Neil'];

        // Act
        $result = array_until('Austin', $names);
    }

    public function testGeneratesAnchorTag()
    {
        $actual = my_link_to('dogs/1', 'Show Dog');

        $expect = "<a href='http://localhost/dogs/1'>Show Dog</a>";

        Should::equal($expect, $actual);
    }

    public function testAppliesAttributesUsingArray()
    {
        $actual = my_link_to('/dogs/1', 'Show Dog', ['class' => 'button']);
        $expect = "<a href='http://localhost/dogs/1' class=\"button\">Show Dog</a>";

        Should::equal($expect, $actual);
    }
}
