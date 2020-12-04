<?php
namespace Tests\Feature;

use App\Days\Day3\Map;
use App\Days\Day3\PatternParser;
use Tests\TestCase;

class Day03Test extends TestCase
{
    const SHORT_PATTERN =
        "..##.......
#...#...#..
.#....#..#.
..#.#...#.#
.#...##..#.
..#.##.....
.#.#.#....#
.#........#
#.##...#...
#...##....#
.#..#...#.#";

    /** @test */
    public function it_parses_one_line_correctly()
    {
        // given
        $line = explode(PHP_EOL, static::SHORT_PATTERN)[0];

        // when
        $parsedLine = PatternParser::parseLine($line);

        // then
        $this->assertIsArray($parsedLine);
        $this->assertCount(11, $parsedLine);
        $this->assertEquals(2, array_sum($parsedLine));
        $this->assertEquals(0, $parsedLine[0]);
        $this->assertEquals(1, $parsedLine[2]);

        // given
        $line = explode(PHP_EOL, static::SHORT_PATTERN)[1];

        // when
        $parsedLine = PatternParser::parseLine($line);

        // then
        $this->assertIsArray($parsedLine);
        $this->assertCount(11, $parsedLine);
        $this->assertEquals(3, array_sum($parsedLine));
    }

    /** @test */
    public function it_parses_pattern_correctly()
    {
        // given
        // Pattern

        // when
        $map = PatternParser::parse(static::SHORT_PATTERN);

        // then
        $this->assertIsArray($map);
        $this->assertCount(11, $map);

        foreach ($map as $item) {
            $this->assertIsArray($item);
            $this->assertCount(11, $item);
        }
    }

    /** @test */
    public function it_traverses_example_map()
    {
        // given
        $map = new Map(static::SHORT_PATTERN);

        // when
        $result = $map->traverse(3, 1);

        // then
        $this->assertEquals(7, $result);
    }

    /** @test */
    public function it_traverses_long_map()
    {
        // given
        $map = new Map(static::LONG_PATTERN);

        // when
        $result = $map->traverse(3, 1);

        // then
        $this->assertEquals(156, $result);
    }

    const LONG_PATTERN = ".........#..##..#..#........#..
#...#..#..#...##.....##.##.#...
....#..............#....#....#.
#.#..#.....#...#.##..#.#.#.....
........#..#.#..#.......#......
.#........#.#..###.#....#.#.#..
........#........#.......#.....
...##..#.#.#........##.........
#.#.##..###............#...#...
............#....#.......###.##
....##....##..#........#......#
............#.#..........#.....
#.#....#....##...#.....#.....#.
......#.#.#...#.....###....#..#
...........##..#.........#..#.#
..#..#.................#..#..#.
.#....###...#.......#.........#
#.#.#.#...#......#.......#...#.
.......#.#.#...#..............#
...##.......#..##.#.......##...
#.#.##....#..##..##..###...###.
.#......##.##.#....#.##........
..###.............##..##..#....
.....#.#...........#..##..##...
.###.#.#......#.....#........##
...#.......#...##..#..#..#.....
..............#.#..##.##..##..#
#..#.#......#............#.....
........#..#....#..............
...#...#..............#.#####..
...##......#........#.#...#....
..##......#............#..#..#.
....#.........#.#.#.....###.#..
#....#........#........#....#.#
.....#...#..##.....##...#.....#
#...#.#.#...##..##.###.#.#.....
......#.#..........#...#.##....
..............##...#..#.......#
........##.....#.....#.#....#..
..............#..#..#...#.....#
##......##.......##...#.#....#.
.....#.............#.#.........
#.........##..#..#.........##..
..#..#.....#####.........##.#..
.......##.#......#........#....
#.................#.#...#....#.
...#........#.###.##.##.....#..
#.....##..#...##.#.#......#....
.....#..#.#..........##..#.##..
..###.............#..#..#...#..
...###..#...#.....##..........#
#.......#.#...#....#..##..#..#.
.#..#.........#..............#.
..######.....#....##......#....
#..##...#......#..#.#....#.....
.#...................#.#.....#.
..#...#.#..#.#......#..#...#..#
..##..##.#.##.........#.#.#....
...#...#...........#..##.##...#
#...#....#....#....#..#.##..#..
..#.##....#....###..#..........
#.#..##.#.#...##.#..#.##..#.#..
#......##...#.#..........#..#..
#.#...#..#...#.#.#..#........#.
#.#.##.#..#...#..#.#.##........
.....#......#........#..#......
...#....#.#....#...............
....#..###..#....#..#....#....#
.#........###..........##.##.#.
#.#......##....##...##.#......#
#..##.##...#...........##.#.#..
.#.....#.#...#.................
##..........#..#....#.....#...#
....#.#..........##..#.....#.##
#.#..#..#..##..........#.......
..#.#.###......................
......##..##.....#..##.##....#.
...#.......#.##....#......#....
...#...#........#...#.#...#..##
##...#....#.#...#.#.##..##...#.
...#.....#...#...#....###.#..#.
..#.#..#........#......#..##..#
...#......#...#.#.##...##.#.#.#
....#.#....#....#.....#.....##.
.....#.#..##.#....##....##.....
.#...###..#.....#............#.
#..#.#.#..#..#...#....#...#....
#.....#..#...#................#
..........#..#.......#......#.#
...#..#......#...#......#......
.#.#.....#.#.#.#......#..#..#..
.....#.........#.#.#.....##.#..
.....#.#.....#..#..#..#.....###
##....#......##....##.#....#.#.
#####........#..........##.....
.#...##...#...#.......#....#...
#.#.##...##...##..##........#..
#.#..............#.#...#...###.
...#.....##..#.........#....#.#
#.#....#....#..##.#..#...#.....
..#....#.#..#...#...##.....#...
....#...#......................
..#...#.......#..#...##....#...
.#........#...#.....##.##...#..
#......#..............#..#..#..
...........#.#..#.#.#....#....#
.##..##.......#...#..#.....#..#
...#.........#.........###..#..
...#.##....#....#.....#.....#..
.#.#.#.........#.#.#....#....#.
...#..........##..#....#.#.....
...#....##................#....
#....##..#..#........##...#....
#...#...##.#............#....#.
##..#....#...#...............#.
..........#.#...#..##..#.#.....
..##...##..#....#.#......#.....
.......#......#.#.....#.....##.
#...###.....##..##....#.#....#.
.###......#.....#.#............
#.....#.....####.##....#..#....
......###.............#......##
.........##.......##..#..#..#..
.#.......#....#...#...#.#......
#...#..#...#........#...##..#..
.#....#........#.........##..#.
..............##.#...##..#.##.#
.#....#...#....#......#..#.....
#....##.#...#.#.....###..#....#
#.......##.#..###..............
#..#..#..#......#.#..#...#..#.#
.......#.#.#..#..#...#..#......
.#..#......#.....#......##..##.
....#....#.......#.......#.#.##
.......#.#................#...#
#.#.....#.......#.#........#...
.....#....##...#......#.....##.
.#......#.#...#..#....#....#.##
##...#.###.#....#..#....#.#...#
....#.##..##.#.............#...
#..#.............##.......#.#..
##.#..#..#.#...........###...##
.#.#.....#......###........#...
#.#...#.#....##......#.#....#..
#.........#..........#.........
.......#....#...#..#.....#...##
.......................#...#..#
.###...........##...#........##
#.#....######.#........#..##.#.
..#.##.#...#.#.......#.##.##..#
#.............###..#.##.#......
...#..##......#...#..###.....#.
..........#.....#..#...##..#...
..##..........#.#..#.....#...#.
...#.......#.....##.........#..
#..#.#...#..#...###...#...#.#..
#.##....#..#.#.......#..#..#...
..#.##.#......#.#......#....#..
..........#...##.....###.......
...#...##..#......#...##.......
....#........#.#.......#..###..
.....#.#..........##.#..#..#.#.
.............##.....#.#..##....
...#...............##...#......
....#......#..#....#...##..#...
.##.#....#.#.....#.#.........#.
.....#.###....#..###..#.#.....#
.#.........##.........##...#...
..#.....###....##..........#..#
........#..#.#.#..#.......#..##
..#.#..#.#............#.##.#..#
.#....#.....#..#...#.......##..
.#...........#.#..#..###.###...
..#.....#..#........#.#........
.#........##........#..#.##....
......#.....##........##..#....
.#..................##....#.#..
.#..#.#..#.#...#........#......
...#..##.#......#..#..........#
....#.##...#....##.............
#....#.##....##.###..#..#..#...
..........#..#...##.##....#..#.
.###.#.....#...#...#...#.......
............#...............#.#
#....#...#......#....#.#.#.#.##
...#..........#.#.#.....###....
#.#...##...#..#.....###...#....
......#...#..#..#..#.##...##...
...#..#.#....#...#.#.........##
##....#..###.#.##.....##.......
..#.#...#..##.......#.#.......#
##......#...........#......#...
.......#..###....###..##.#...##
.........#.....#..#.......##..#
.......#.##..#....#...#.#...#..
#..#.#..................##.#..#
...#..#..#.....#..#........#...
...#.#..###..#.....##...#....#.
..#..#......#...........#...#..
#...##.##..###.......##........
.#.....#..#....#.....#.##....#.
#..#........#.#....#..#...#.###
..#...#.#.#.....#.....#..#.....
.##.............#.#......##...#
.#....#####............#.....##
#.###.......#.#...##.....#.....
......#.##..#...#..#..##.#..##.
......#.#...##.....#...#....##.
....#............#...#...#....#
.........##.#.#....#....#....##
.#...##.#...#.......#.##....#.#
#....#.#...#.#...#.#.#...#.....
.#.#.........##..#..#..........
.#.........#.#.....#..#.#..###.
....##.#.#..........#..####....
....#..#.#.#...#...#..#....#...
..#.#...#...##.......#.#.#..#..
...##...#......#.....#.#...#..#
......#.###.#.......##...#...#.
.....#.#.#......##..........###
##.#.#.#..#....#...............
.#.#.##.......#....#.#.....#..#
.........#...#.#..#.......#....
....#.####.#......#...#...##...
#..#..#..#..#....#...##.....##.
......####.#..##..#.....##.....
##.#.........#........#..#.#...
.#.#....#....#.......#.#....##.
....#....#.......##..#.....#...
.#......#..#....#.#............
#..#.#.##.....#..#.#.#.#.#.##..
.#.....#.....#...#..#.#...#.#..
.#.#.##............#.#.#.#.#.#.
.##..........#.....#...###.....
#.#...#...#................#.#.
##...#.##.....#.....#.#.##.....
####.....##..........#......#..
#.............#..............#.
.###....#.#...#..#..#..#.......
..#.#.....#...#..#..####.......
...#.#..#........#..##..#..#.##
.#........#..........#.#...##..
.#.......#.#.#..#...#..#.#...##
.#.....##......##..............
......#..#.#.##...##.#.....#...
.........#.#...##.....##....#.#
.....##...#........#..#.#..#.#.
.#.##..#.....##...#...###.#.#..
...##...#...#..#.#..#..........
##..............#...#...#.#..#.
......#..#......#..#.....#...#.
.......#...#..#....#.....#.....
..##.....##..#.#........#......
.###.#...#.....................
..#...#.................#...#..
#..#.##...####.............#...
.##....#..####.......#.........
#..#...###...#...#..#..##......
....#.##.#.#.........#.....#..#
.....#...#.....#.#.#.##.#...##.
.............#........#.....#..
...##.###.#....##.......#..#...
#..#....#....#.#............#..
.........#.##........##.....#..
.........#.#.#..#..#.......#...
.......#.#..#.......#.....#.#..
##.#.....##...##.....#.#.......
.#.#.#......##.##.#.........#..
..#.##..###.....###.........##.
.#......#..#..##...#.#...##.#.#
......#.#............#.....#...
###.#..#..#..#..#.##...#.......
.#.#.##..###....#......##..###.
#...#.#.#..#..#..##.#.##....#..
..#...#...####...#......####.##
..##.#.####........#..#......#.
.#..#.......#...#.#.........#..
........#.#....#..#####..#.....
.#...........#..#..#..#...#....
....#....#...#.................
....##..#....##....#..#....#.##
....#.##.....###...#...##.##...
......##.#..##.#.#.#....#.#.#..
##.#...###....#.#..#.#.###....#
......###..#..#..........##...#
..........#.##...##..#....##.#.
.#...#.#..#.#.#..#.....#.......
.#....#..#.#..#.#...##.#.#.....
.##.....#...#..##.#........#...
....#......#.........#....#..##
.#..#.#.#.#..#..#.#.........#..
.........#.....#...#....#......
#..#..#........#...#.#.........
...#.#.#...##.#.#...#..#......#
#.#.#.#........#...#..#.....#..
.###..#..#..###..#..#..........
.....#......#.#..#...#.......#.
##.##.........#.......##.......
#...##.......#..#.#.......#....
#..#..#.....#...#......#.......
.#..#..#.##....#.#..#...#...#..
.#...#.....#..#.........#..#...
...#.#.#.......#....#..##.....#
.........#..##.#..#..#.#.......
#.##.....##..###..#..#..#.##...
........#......#...##...###..##
.##....##..#..#..###......#....
............##......#...#..##..
...##.......#......#...##.##..#
...#..#..#.#...####.#.......#..
..#.##..#....#......#.#.....#..
..#.##..............#..##.....#
.....##....#......#....#......#
......#..#......#.........#..#.
...#.##.###...###..#.##........
..........####.#.##.....#..#.##
#...##...........#...........##
#.#..#.#....#.#..#....##......#
.......#...#.....#......#.#.##.
....#.##..##..........#..#.....
#.#.#...#......#...#.....#.##.#
........#.......#..##.....##...
.....####.#....#.#.............";
}
