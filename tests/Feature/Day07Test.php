<?php
namespace Tests\Feature;

use App\Days\Day7\BagsCollection;
use App\Days\Day7\Parser;
use Tests\TestCase;

class Day07Test extends TestCase
{
    /** @test */
    public function line_parser_removes_surplus_strings()
    {
        // given
        $line = explode(PHP_EOL, static::RULES_SHORT)[0];

        // when
        $lineCleaned = Parser::removeSurplusStrings($line);
        $parsed = Parser::parseLine($line);

        // then
        $this->assertIsArray($parsed);
        $this->assertEquals('light red', $parsed[0]);
        $this->assertCount(2, $parsed[1]);
        $this->assertEquals('bright white', $parsed[1][0]);
    }

    /** @test */
    public function it_constructs_bags_collection_properly()
    {
        // given
        $lines = explode(PHP_EOL, static::RULES_SHORT);
        $bags = new BagsCollection();

        // when
        foreach ($lines as $line) {
            $bags->processLine($line);
        }

        // then
        $this->assertCount(9, $bags->bags);
    }

    /** @test */
    public function it_finds_shiny_gold()
    {
        // given
        $lines = explode(PHP_EOL, static::RULES_SHORT);
        $bags = (new BagsCollection())->processManyLines($lines);

        // when
        $result = $bags->search('shiny gold');

        // then
        $this->assertEquals(4, $result);
    }

    /** @test */
    public function it_finds_shiny_gold_in_long_rules()
    {
        // given
        $lines = explode(PHP_EOL, static::RULES_LONG);
        $bags = (new BagsCollection())->processManyLines($lines);

        // when
        $result = $bags->search('shiny gold');

        // then
        $this->assertEquals(112, $result);
    }

    const RULES_SHORT = "light red bags contain 1 bright white bag, 2 muted yellow bags.
dark orange bags contain 3 bright white bags, 4 muted yellow bags.
bright white bags contain 1 shiny gold bag.
muted yellow bags contain 2 shiny gold bags, 9 faded blue bags.
shiny gold bags contain 1 dark olive bag, 2 vibrant plum bags.
dark olive bags contain 3 faded blue bags, 4 dotted black bags.
vibrant plum bags contain 5 faded blue bags, 6 dotted black bags.
faded blue bags contain no other bags.
dotted black bags contain no other bags.";

    const RULES_LONG = "dull blue bags contain 2 dotted green bags, 1 dull brown bag, 3 striped tomato bags, 5 muted blue bags.
dotted cyan bags contain 2 faded lavender bags, 1 drab fuchsia bag, 5 bright blue bags.
clear magenta bags contain 1 wavy salmon bag, 3 dull lime bags, 2 striped white bags.
drab white bags contain 1 drab lavender bag, 1 plaid maroon bag.
bright bronze bags contain 4 striped purple bags, 1 dull crimson bag, 4 dotted plum bags, 1 vibrant silver bag.
drab tan bags contain 5 dim white bags, 5 wavy brown bags.
wavy cyan bags contain 2 striped lavender bags, 5 mirrored beige bags, 4 muted purple bags, 3 muted red bags.
bright magenta bags contain 5 faded beige bags, 5 muted blue bags.
wavy red bags contain 1 light magenta bag, 4 wavy plum bags, 2 vibrant tan bags, 3 dotted turquoise bags.
drab purple bags contain 3 dotted brown bags, 1 drab bronze bag.
dull coral bags contain 2 shiny magenta bags, 2 wavy teal bags, 5 dotted indigo bags.
mirrored plum bags contain 5 bright bronze bags, 5 shiny gold bags, 5 dark plum bags.
shiny yellow bags contain 5 clear black bags, 5 light cyan bags, 2 mirrored coral bags.
clear brown bags contain 3 muted salmon bags, 1 dark plum bag, 2 wavy white bags, 5 dull maroon bags.
pale gray bags contain 4 striped gray bags.
light turquoise bags contain 4 clear black bags, 3 drab bronze bags, 5 drab crimson bags, 2 bright lime bags.
muted orange bags contain 3 drab white bags.
muted plum bags contain 3 bright plum bags.
dull salmon bags contain 3 striped olive bags.
pale black bags contain 2 vibrant gold bags, 4 plaid coral bags, 1 clear gray bag, 2 drab olive bags.
dark lavender bags contain 3 dotted turquoise bags, 1 plaid blue bag.
pale chartreuse bags contain 1 dotted gray bag, 4 plaid blue bags.
posh chartreuse bags contain 3 posh magenta bags, 3 wavy violet bags.
light brown bags contain 3 clear white bags, 4 dim brown bags, 5 striped bronze bags, 3 vibrant silver bags.
shiny gray bags contain 4 shiny crimson bags, 5 wavy brown bags, 1 clear beige bag, 1 faded bronze bag.
dotted maroon bags contain 1 clear turquoise bag, 4 clear white bags, 5 muted cyan bags.
shiny green bags contain 2 dark indigo bags, 2 dotted indigo bags.
bright orange bags contain 3 drab bronze bags, 3 muted salmon bags, 4 posh gray bags.
mirrored salmon bags contain 3 wavy yellow bags, 2 dotted yellow bags, 3 drab coral bags.
plaid black bags contain 4 muted fuchsia bags, 2 muted yellow bags, 1 plaid blue bag, 3 dark aqua bags.
light tan bags contain 5 dark silver bags, 5 striped bronze bags, 4 dotted green bags, 2 shiny salmon bags.
striped maroon bags contain 1 plaid silver bag.
muted tomato bags contain 3 bright purple bags, 3 shiny brown bags.
striped violet bags contain 4 dotted gray bags, 1 clear turquoise bag, 4 bright violet bags.
dull gold bags contain 5 light cyan bags, 1 mirrored yellow bag, 1 light coral bag, 5 plaid turquoise bags.
shiny white bags contain 2 dark purple bags.
dim black bags contain 3 posh green bags.
faded coral bags contain 4 wavy white bags, 3 dull tan bags, 1 mirrored turquoise bag, 1 dotted crimson bag.
wavy lime bags contain 3 mirrored purple bags.
posh crimson bags contain 4 wavy olive bags, 4 pale purple bags.
mirrored purple bags contain 2 light gray bags, 2 plaid beige bags.
mirrored yellow bags contain 3 shiny salmon bags, 4 dotted plum bags.
vibrant maroon bags contain 2 vibrant gold bags.
dull plum bags contain 4 clear orange bags.
muted blue bags contain 3 dark lavender bags.
dim bronze bags contain 4 dark purple bags.
shiny orange bags contain 5 faded coral bags, 3 bright lime bags, 2 dim indigo bags, 2 dotted yellow bags.
light black bags contain 4 dark coral bags.
vibrant black bags contain 3 muted red bags, 3 faded coral bags, 4 plaid chartreuse bags, 3 dull maroon bags.
shiny aqua bags contain 4 dim tomato bags, 1 bright lime bag.
muted violet bags contain 4 wavy gold bags, 4 shiny gold bags.
dim lavender bags contain 3 pale crimson bags, 1 posh magenta bag, 3 vibrant olive bags, 1 plaid violet bag.
bright chartreuse bags contain 5 mirrored tan bags.
posh tomato bags contain 3 light aqua bags, 1 drab tomato bag, 3 dull green bags.
posh cyan bags contain 2 posh fuchsia bags, 4 pale tan bags, 3 posh blue bags.
mirrored silver bags contain 1 light purple bag.
striped tomato bags contain no other bags.
shiny brown bags contain 1 mirrored brown bag, 4 wavy lavender bags, 5 striped olive bags, 3 light cyan bags.
shiny maroon bags contain 2 drab tomato bags, 4 drab black bags, 3 posh tomato bags.
pale lime bags contain 1 dark indigo bag, 3 muted violet bags.
pale purple bags contain 1 dark silver bag, 2 wavy yellow bags, 5 striped salmon bags.
wavy white bags contain 5 clear beige bags, 1 striped tan bag, 2 posh gray bags, 1 striped yellow bag.
plaid maroon bags contain 1 muted cyan bag.
plaid gray bags contain 2 striped gray bags, 5 faded coral bags.
faded brown bags contain 3 mirrored olive bags, 2 shiny aqua bags, 5 dim maroon bags.
faded black bags contain 2 dotted beige bags, 5 dull indigo bags, 4 wavy olive bags, 5 mirrored coral bags.
light blue bags contain 3 plaid silver bags, 3 mirrored tomato bags, 3 dull indigo bags, 5 dull aqua bags.
mirrored bronze bags contain 4 drab turquoise bags, 4 wavy lavender bags, 5 dark maroon bags.
drab violet bags contain 3 drab lavender bags, 4 pale salmon bags, 1 wavy brown bag.
bright tomato bags contain 2 dotted olive bags, 5 posh purple bags, 1 pale magenta bag, 5 shiny crimson bags.
plaid bronze bags contain 1 shiny olive bag, 4 posh indigo bags, 4 clear beige bags.
vibrant magenta bags contain 3 mirrored brown bags.
striped turquoise bags contain 2 striped lavender bags, 5 clear beige bags, 4 dull indigo bags.
drab bronze bags contain 4 posh green bags, 3 striped maroon bags, 5 plaid beige bags, 4 clear gray bags.
wavy plum bags contain 4 shiny plum bags, 1 striped tomato bag, 1 striped bronze bag.
mirrored coral bags contain 3 clear turquoise bags, 3 muted plum bags, 3 drab turquoise bags, 2 drab lavender bags.
dark coral bags contain 1 clear purple bag, 1 muted lavender bag, 4 plaid yellow bags, 4 faded tomato bags.
plaid fuchsia bags contain 1 dull lime bag, 3 drab bronze bags, 2 wavy tomato bags, 3 dotted magenta bags.
faded turquoise bags contain 3 vibrant indigo bags, 2 dark bronze bags.
posh gray bags contain no other bags.
bright fuchsia bags contain 3 muted turquoise bags, 1 dark lime bag.
plaid magenta bags contain 3 mirrored yellow bags, 5 mirrored brown bags, 4 drab violet bags, 1 muted blue bag.
dim brown bags contain 5 wavy indigo bags.
vibrant olive bags contain 2 striped olive bags, 5 dotted crimson bags, 1 light coral bag.
dim indigo bags contain 5 striped turquoise bags, 3 light gray bags, 2 pale salmon bags, 2 clear gray bags.
pale gold bags contain 4 bright turquoise bags.
clear bronze bags contain 3 dim tomato bags.
posh black bags contain 3 drab plum bags, 2 dull indigo bags, 4 striped bronze bags.
shiny coral bags contain 5 light blue bags, 5 faded green bags, 2 muted coral bags, 2 posh teal bags.
mirrored olive bags contain 2 plaid green bags, 4 mirrored teal bags.
dotted plum bags contain 2 striped tomato bags.
bright gray bags contain 1 dim tomato bag, 1 bright aqua bag.
bright plum bags contain 5 dotted magenta bags, 2 plaid bronze bags.
vibrant purple bags contain 3 mirrored turquoise bags, 2 dull blue bags, 4 mirrored aqua bags.
faded cyan bags contain 1 plaid yellow bag, 3 muted orange bags, 5 posh crimson bags, 2 wavy cyan bags.
dark indigo bags contain 3 dark lavender bags, 2 light bronze bags, 1 drab magenta bag.
dotted violet bags contain 2 striped turquoise bags, 3 shiny gold bags, 2 pale cyan bags, 5 wavy violet bags.
drab gray bags contain 2 plaid maroon bags, 5 muted indigo bags, 5 clear beige bags.
drab indigo bags contain 5 mirrored aqua bags, 3 plaid chartreuse bags.
wavy tomato bags contain 2 drab white bags, 1 bright violet bag, 4 mirrored plum bags, 2 mirrored gray bags.
pale tan bags contain 2 muted blue bags, 3 dull tan bags, 5 vibrant orange bags, 4 vibrant silver bags.
wavy turquoise bags contain 5 dotted green bags, 4 posh yellow bags.
drab tomato bags contain 4 posh black bags, 3 drab fuchsia bags, 1 muted coral bag, 3 wavy brown bags.
striped green bags contain 2 light indigo bags, 3 muted lavender bags, 1 dim tomato bag.
dark beige bags contain 2 posh black bags, 3 dull indigo bags, 1 faded olive bag.
dark green bags contain 2 shiny gold bags, 1 striped turquoise bag, 1 faded coral bag.
dark lime bags contain 3 clear olive bags, 5 drab blue bags, 2 striped crimson bags.
shiny cyan bags contain 4 dull teal bags, 3 muted olive bags.
dotted chartreuse bags contain 2 plaid beige bags, 4 muted aqua bags.
plaid violet bags contain 4 posh indigo bags, 1 dull maroon bag, 4 plaid blue bags.
posh brown bags contain 1 pale cyan bag, 4 dull fuchsia bags.
dull crimson bags contain 1 striped bronze bag.
plaid lavender bags contain 3 plaid cyan bags.
bright green bags contain 5 wavy aqua bags, 5 clear aqua bags, 3 vibrant tan bags, 3 dotted plum bags.
plaid tomato bags contain 5 drab olive bags, 2 clear turquoise bags.
pale lavender bags contain 5 dark plum bags, 2 dull olive bags.
clear silver bags contain 3 dull fuchsia bags, 1 vibrant white bag, 2 bright chartreuse bags.
drab yellow bags contain 3 bright yellow bags, 3 dim beige bags.
faded beige bags contain 2 wavy coral bags, 3 bright tomato bags, 1 bright plum bag.
shiny black bags contain 3 dull fuchsia bags, 5 wavy brown bags, 2 clear aqua bags, 5 faded coral bags.
dull green bags contain 4 light salmon bags.
muted lime bags contain 1 vibrant tan bag, 2 plaid chartreuse bags.
posh tan bags contain 5 dull tan bags, 5 posh purple bags.
plaid tan bags contain 2 dull beige bags.
drab lavender bags contain 5 light gray bags, 1 striped turquoise bag, 2 striped yellow bags, 3 plaid blue bags.
drab aqua bags contain 4 vibrant plum bags, 4 plaid magenta bags, 1 clear silver bag.
mirrored turquoise bags contain 2 shiny plum bags.
wavy aqua bags contain 3 faded coral bags.
striped lime bags contain 3 bright beige bags.
vibrant coral bags contain 5 dark red bags, 1 wavy aqua bag, 2 dark plum bags.
plaid yellow bags contain 5 striped purple bags, 3 faded coral bags.
clear gold bags contain 4 dull chartreuse bags, 5 dull lavender bags, 2 plaid plum bags.
drab black bags contain 4 wavy yellow bags, 4 dull coral bags.
plaid green bags contain 4 clear lavender bags, 1 dull crimson bag, 5 mirrored purple bags, 3 dull violet bags.
dotted turquoise bags contain 5 striped tomato bags, 5 dull maroon bags, 1 striped maroon bag, 4 plaid silver bags.
faded gray bags contain 1 light coral bag.
mirrored tan bags contain 3 light aqua bags, 2 wavy crimson bags, 1 striped olive bag.
pale brown bags contain 4 vibrant gray bags, 2 light chartreuse bags.
dim teal bags contain 2 faded coral bags, 1 dark cyan bag, 4 dotted yellow bags.
posh violet bags contain 4 dull blue bags, 1 mirrored turquoise bag, 1 striped salmon bag.
dim red bags contain 2 light crimson bags, 3 dark olive bags, 1 striped gray bag.
striped brown bags contain 4 clear purple bags, 5 mirrored teal bags, 3 bright aqua bags, 5 striped bronze bags.
muted gray bags contain 3 dull tan bags, 1 dim purple bag.
muted beige bags contain 4 wavy magenta bags, 1 dark magenta bag.
dotted bronze bags contain 3 dark violet bags, 3 bright blue bags.
posh purple bags contain 5 plaid silver bags, 3 posh indigo bags, 4 wavy green bags, 1 dark lavender bag.
wavy lavender bags contain 3 drab fuchsia bags, 5 mirrored cyan bags, 5 clear aqua bags.
mirrored aqua bags contain 4 posh gray bags.
wavy brown bags contain 2 plaid blue bags.
pale teal bags contain 5 dim tomato bags, 2 bright red bags, 1 clear lavender bag.
mirrored black bags contain 1 shiny aqua bag.
clear violet bags contain 3 muted olive bags.
drab blue bags contain 5 dark red bags.
muted indigo bags contain 4 posh red bags.
bright crimson bags contain 2 bright blue bags.
dark cyan bags contain 1 muted cyan bag, 1 dull crimson bag.
dull aqua bags contain 4 dull crimson bags, 2 striped purple bags.
vibrant blue bags contain 3 wavy yellow bags, 4 light cyan bags, 3 dark cyan bags, 1 pale maroon bag.
shiny lime bags contain 1 faded coral bag, 4 dull crimson bags, 4 wavy violet bags.
dim salmon bags contain 3 vibrant lavender bags, 4 muted yellow bags.
shiny blue bags contain 5 plaid turquoise bags, 2 drab silver bags, 2 clear green bags, 1 dotted teal bag.
dotted green bags contain 3 posh gray bags, 3 striped turquoise bags, 5 muted red bags.
mirrored violet bags contain 4 striped turquoise bags, 1 faded cyan bag, 4 dull fuchsia bags, 3 bright magenta bags.
vibrant beige bags contain 3 vibrant white bags, 2 vibrant plum bags.
dark tomato bags contain 2 dotted turquoise bags.
dotted olive bags contain 4 bright bronze bags, 2 plaid blue bags.
faded green bags contain 5 plaid maroon bags.
faded magenta bags contain 5 wavy green bags.
muted fuchsia bags contain 3 drab green bags.
pale white bags contain 5 shiny beige bags, 1 dim salmon bag, 2 light orange bags, 1 wavy brown bag.
light silver bags contain 2 wavy yellow bags, 3 muted orange bags.
muted aqua bags contain 5 light tan bags, 1 striped white bag, 4 pale magenta bags.
dark tan bags contain 1 wavy chartreuse bag, 4 dull silver bags, 3 posh white bags.
light lavender bags contain 4 shiny salmon bags, 5 light coral bags, 3 dotted yellow bags, 1 mirrored tomato bag.
striped cyan bags contain 5 light crimson bags, 1 pale salmon bag, 1 pale purple bag, 3 drab teal bags.
mirrored chartreuse bags contain 4 pale salmon bags.
muted silver bags contain 5 wavy chartreuse bags, 4 clear gray bags.
shiny olive bags contain no other bags.
clear lavender bags contain 1 wavy cyan bag, 4 bright blue bags, 1 muted coral bag, 1 dim lime bag.
dotted crimson bags contain 1 drab plum bag.
shiny salmon bags contain 1 plaid beige bag, 2 dull blue bags, 5 muted cyan bags, 2 striped turquoise bags.
shiny lavender bags contain 1 vibrant lavender bag, 3 mirrored turquoise bags.
clear white bags contain 3 muted yellow bags, 5 vibrant chartreuse bags, 5 posh black bags.
bright blue bags contain 5 muted red bags.
posh olive bags contain 5 striped purple bags, 3 faded gold bags, 4 shiny salmon bags.
dim olive bags contain 4 bright teal bags.
plaid teal bags contain 4 pale lime bags, 5 dotted gold bags.
plaid orange bags contain 2 muted aqua bags, 4 faded blue bags, 1 muted silver bag, 4 posh gray bags.
faded chartreuse bags contain 5 vibrant coral bags.
faded lavender bags contain 4 wavy plum bags.
dim blue bags contain 1 bright coral bag.
dim green bags contain 2 dull gold bags, 2 wavy yellow bags, 5 striped magenta bags.
striped crimson bags contain no other bags.
striped lavender bags contain 1 dim purple bag, 2 dull brown bags, 1 posh gray bag.
muted green bags contain 2 plaid maroon bags, 4 striped white bags, 3 drab bronze bags.
striped salmon bags contain 1 light fuchsia bag, 2 faded lavender bags, 2 muted coral bags.
posh coral bags contain 1 mirrored tomato bag, 4 faded aqua bags, 2 vibrant chartreuse bags.
bright silver bags contain 1 bright lime bag, 3 light fuchsia bags, 4 vibrant tan bags, 1 striped maroon bag.
clear yellow bags contain 2 dull gray bags, 4 light fuchsia bags, 5 plaid maroon bags, 3 muted chartreuse bags.
dull cyan bags contain 1 muted teal bag, 4 clear maroon bags, 4 drab turquoise bags, 1 pale olive bag.
bright lavender bags contain 3 wavy plum bags, 3 pale maroon bags.
mirrored indigo bags contain 1 light plum bag, 3 faded tomato bags, 2 dim lime bags, 3 light indigo bags.
dull lavender bags contain 5 vibrant lime bags, 2 dim white bags, 1 light beige bag.
mirrored beige bags contain 1 plaid violet bag, 3 shiny plum bags.
dotted tomato bags contain 3 faded beige bags, 5 dull fuchsia bags, 5 mirrored beige bags, 4 light green bags.
dark salmon bags contain 4 bright maroon bags.
drab crimson bags contain 1 wavy aqua bag, 3 dark purple bags, 5 dim red bags, 3 dim purple bags.
posh maroon bags contain 2 shiny tan bags.
dull orange bags contain 2 striped white bags, 3 pale cyan bags, 1 pale teal bag.
dim maroon bags contain 4 vibrant aqua bags, 5 dark brown bags.
clear turquoise bags contain 2 drab plum bags.
wavy beige bags contain 4 plaid bronze bags, 2 dark maroon bags, 1 pale crimson bag.
drab red bags contain 5 dim lavender bags, 3 light coral bags, 5 dark aqua bags.
bright indigo bags contain 4 clear lavender bags.
clear aqua bags contain 3 dark lavender bags, 2 wavy plum bags, 4 shiny plum bags, 3 light cyan bags.
dotted salmon bags contain 1 drab salmon bag, 3 light fuchsia bags, 4 light silver bags.
muted crimson bags contain 2 dark coral bags, 1 clear purple bag, 2 light salmon bags.
striped coral bags contain 1 dim brown bag, 2 vibrant beige bags.
dark silver bags contain 2 clear aqua bags, 3 dull tan bags, 3 dark lavender bags.
dark brown bags contain 1 light fuchsia bag, 2 light magenta bags, 5 dim salmon bags.
wavy yellow bags contain 1 light orange bag.
pale yellow bags contain 3 dull blue bags, 5 dotted crimson bags, 5 striped tomato bags, 4 wavy plum bags.
dim chartreuse bags contain 5 muted gray bags.
pale salmon bags contain 2 dull brown bags, 4 shiny olive bags, 2 plaid turquoise bags.
posh aqua bags contain 2 faded beige bags, 2 dark black bags, 4 light aqua bags.
muted lavender bags contain 5 shiny salmon bags, 2 dim cyan bags, 5 striped crimson bags, 5 posh purple bags.
dim aqua bags contain 4 muted cyan bags, 5 light beige bags.
dull chartreuse bags contain 5 dotted green bags, 5 dull olive bags.
dotted orange bags contain 3 dull maroon bags, 1 shiny gray bag.
striped black bags contain 1 mirrored yellow bag, 1 vibrant lavender bag.
posh teal bags contain 4 dotted indigo bags, 4 pale bronze bags.
bright olive bags contain 2 dull crimson bags, 3 muted chartreuse bags, 3 pale fuchsia bags, 1 dotted maroon bag.
pale bronze bags contain 3 mirrored blue bags, 3 striped white bags.
wavy magenta bags contain 1 pale salmon bag, 3 shiny lavender bags, 4 dull lime bags.
clear lime bags contain 5 dim chartreuse bags, 5 plaid purple bags.
bright aqua bags contain 4 muted coral bags.
dotted silver bags contain 4 muted chartreuse bags.
dotted teal bags contain 4 light crimson bags, 2 dim salmon bags, 2 drab tomato bags, 3 vibrant coral bags.
bright teal bags contain 3 posh fuchsia bags, 3 drab bronze bags, 3 dim purple bags.
vibrant brown bags contain 4 wavy plum bags.
dim tan bags contain 3 vibrant black bags, 5 posh maroon bags, 4 wavy indigo bags.
light beige bags contain 3 dotted white bags, 2 dim cyan bags, 4 clear turquoise bags.
drab lime bags contain 3 light salmon bags, 2 muted blue bags, 3 muted coral bags, 2 clear blue bags.
posh red bags contain 2 muted white bags.
pale violet bags contain 1 mirrored teal bag, 2 dim silver bags, 4 clear aqua bags, 3 dotted cyan bags.
drab chartreuse bags contain 3 light beige bags.
drab plum bags contain 1 shiny salmon bag.
drab maroon bags contain 2 wavy white bags.
dim plum bags contain 3 posh bronze bags, 2 clear turquoise bags, 5 muted cyan bags, 2 light indigo bags.
clear green bags contain 2 vibrant violet bags, 5 shiny olive bags, 2 wavy aqua bags.
pale maroon bags contain 3 striped turquoise bags, 3 striped bronze bags, 5 drab bronze bags.
dull brown bags contain 2 dull maroon bags.
dim gray bags contain 3 posh black bags, 2 light yellow bags, 1 posh indigo bag, 1 pale blue bag.
plaid beige bags contain no other bags.
striped bronze bags contain 3 posh green bags, 3 posh gray bags.
drab teal bags contain 3 shiny indigo bags.
bright cyan bags contain 4 muted plum bags, 3 dotted crimson bags.
wavy chartreuse bags contain 2 bright beige bags.
vibrant tomato bags contain 5 dull olive bags.
dark plum bags contain 1 light coral bag, 4 plaid beige bags.
shiny indigo bags contain 1 clear olive bag, 4 shiny green bags, 5 dull cyan bags, 5 plaid plum bags.
light indigo bags contain 3 shiny plum bags.
posh lime bags contain 5 drab lavender bags, 1 light tomato bag, 1 posh green bag, 3 mirrored indigo bags.
muted gold bags contain 3 dull blue bags, 5 posh maroon bags, 2 dim teal bags, 2 muted plum bags.
shiny chartreuse bags contain 5 shiny plum bags, 3 wavy magenta bags.
dark orange bags contain 3 mirrored olive bags, 4 light purple bags.
dim cyan bags contain 5 dim purple bags, 2 drab bronze bags, 5 dotted turquoise bags.
posh plum bags contain 4 muted red bags.
vibrant lavender bags contain 3 dull aqua bags, 1 dim beige bag.
shiny violet bags contain 2 dim salmon bags.
plaid lime bags contain 3 bright bronze bags, 1 drab bronze bag, 2 muted cyan bags, 5 bright lavender bags.
dim orange bags contain 3 light tan bags, 4 faded gray bags, 3 clear turquoise bags.
striped gold bags contain 2 drab olive bags.
posh silver bags contain 2 light tan bags, 2 light white bags.
dull fuchsia bags contain 5 faded coral bags, 5 vibrant chartreuse bags, 2 dark plum bags, 2 bright blue bags.
dotted indigo bags contain 4 vibrant turquoise bags, 3 clear black bags, 3 vibrant silver bags, 2 bright blue bags.
dotted coral bags contain 4 dotted teal bags, 5 striped bronze bags, 4 dark beige bags, 2 light bronze bags.
muted olive bags contain 2 dotted coral bags.
dark crimson bags contain 4 drab fuchsia bags, 3 wavy yellow bags.
dark blue bags contain 2 drab cyan bags, 2 dull chartreuse bags, 3 bright teal bags, 2 dull black bags.
pale beige bags contain 4 dotted black bags, 3 dotted maroon bags, 2 dotted salmon bags, 4 shiny white bags.
faded gold bags contain 1 plaid silver bag, 5 clear gray bags, 1 posh indigo bag, 1 striped bronze bag.
muted magenta bags contain 5 dotted black bags.
pale aqua bags contain 3 bright salmon bags, 1 clear bronze bag.
muted maroon bags contain 5 bright beige bags, 3 dark bronze bags.
bright white bags contain 1 light turquoise bag, 3 dull aqua bags.
clear plum bags contain 1 dim red bag, 2 vibrant aqua bags, 1 plaid beige bag.
pale fuchsia bags contain 5 dotted plum bags.
dull teal bags contain 2 clear gray bags, 1 drab orange bag.
dark red bags contain 4 wavy violet bags, 4 bright violet bags, 2 shiny tan bags.
light orange bags contain 4 shiny plum bags, 2 striped maroon bags.
faded fuchsia bags contain 5 dull turquoise bags.
striped white bags contain 3 plaid violet bags, 1 muted plum bag, 5 dotted magenta bags, 5 muted gray bags.
muted brown bags contain 1 dim teal bag, 3 vibrant bronze bags, 3 plaid maroon bags.
wavy gray bags contain 1 dark chartreuse bag, 2 dull lavender bags, 2 dull fuchsia bags, 4 posh fuchsia bags.
striped magenta bags contain 2 muted red bags, 1 plaid blue bag.
mirrored gold bags contain 1 dotted tan bag.
muted purple bags contain 5 plaid coral bags, 4 posh fuchsia bags.
plaid cyan bags contain 5 dim green bags, 4 plaid silver bags, 3 dark green bags, 2 light crimson bags.
pale crimson bags contain 3 shiny olive bags, 5 dark brown bags.
pale olive bags contain 3 striped gray bags, 5 light white bags, 3 faded bronze bags, 2 mirrored purple bags.
shiny gold bags contain 4 bright lavender bags, 1 striped maroon bag, 2 plaid silver bags.
striped orange bags contain 1 dull blue bag, 2 muted salmon bags, 3 dull cyan bags.
dim yellow bags contain 4 striped fuchsia bags.
wavy black bags contain 3 shiny olive bags, 4 shiny red bags.
faded violet bags contain 2 dim aqua bags, 2 posh white bags, 3 drab gray bags, 4 posh red bags.
clear tomato bags contain 4 posh indigo bags, 1 dim teal bag, 2 dull teal bags.
dark olive bags contain 4 clear gray bags.
wavy gold bags contain 4 plaid silver bags, 2 muted blue bags.
dim magenta bags contain 3 dark yellow bags, 5 bright beige bags.
pale tomato bags contain 3 faded magenta bags.
light plum bags contain 3 drab lavender bags, 3 dotted magenta bags, 1 plaid bronze bag, 1 striped crimson bag.
dark white bags contain 1 shiny lavender bag, 3 dark blue bags, 1 dotted gold bag, 1 dull fuchsia bag.
mirrored crimson bags contain 4 pale yellow bags, 3 dotted violet bags.
faded teal bags contain 5 dotted gold bags, 4 mirrored tomato bags.
vibrant bronze bags contain 2 faded olive bags, 3 bright tan bags, 1 posh purple bag.
vibrant lime bags contain 3 light green bags, 1 shiny gold bag.
bright yellow bags contain 3 wavy lavender bags.
light tomato bags contain 1 vibrant aqua bag.
dim lime bags contain 2 muted plum bags, 3 striped magenta bags, 1 bright lavender bag, 1 light orange bag.
vibrant white bags contain 3 dark lavender bags, 3 clear aqua bags, 2 clear green bags, 3 dull aqua bags.
dotted magenta bags contain 5 dark lavender bags.
clear gray bags contain 1 striped tomato bag.
light olive bags contain 1 drab violet bag, 5 drab lavender bags.
pale red bags contain 2 clear yellow bags, 2 bright black bags, 4 posh indigo bags.
striped beige bags contain 5 dark lavender bags, 3 plaid beige bags, 5 dim tan bags.
vibrant fuchsia bags contain 1 plaid brown bag, 5 shiny bronze bags, 1 dark blue bag.
muted yellow bags contain 2 clear black bags, 4 wavy plum bags.
faded aqua bags contain 3 dim orange bags.
faded silver bags contain 2 dotted magenta bags, 1 vibrant turquoise bag.
light coral bags contain 2 drab bronze bags, 1 faded lavender bag.
clear olive bags contain 3 vibrant aqua bags, 2 dark black bags, 2 mirrored yellow bags, 2 dull gold bags.
dull turquoise bags contain 2 dull beige bags, 3 mirrored yellow bags.
vibrant chartreuse bags contain 4 clear aqua bags.
faded white bags contain 1 pale maroon bag, 3 dull olive bags, 5 shiny olive bags.
vibrant aqua bags contain 4 dim beige bags.
posh blue bags contain 2 muted yellow bags, 5 dotted maroon bags, 3 dotted white bags, 3 dull lime bags.
muted teal bags contain 4 dim salmon bags, 3 vibrant aqua bags, 3 light white bags.
clear fuchsia bags contain 4 clear indigo bags, 2 bright teal bags.
light violet bags contain 1 dark indigo bag.
drab green bags contain 3 dull aqua bags, 1 drab silver bag, 1 drab orange bag.
drab beige bags contain 3 drab lavender bags, 3 clear gold bags, 5 bright purple bags, 5 light plum bags.
light magenta bags contain 1 light plum bag, 5 faded green bags.
dull black bags contain 2 posh fuchsia bags, 2 mirrored orange bags.
posh beige bags contain 3 mirrored tan bags, 4 vibrant silver bags, 4 dull maroon bags, 1 dim chartreuse bag.
plaid white bags contain 1 vibrant beige bag.
clear chartreuse bags contain 2 pale bronze bags, 1 pale lavender bag, 3 mirrored plum bags, 5 plaid magenta bags.
wavy olive bags contain 2 clear beige bags, 4 vibrant magenta bags.
light bronze bags contain 3 striped white bags, 1 drab fuchsia bag, 2 pale salmon bags, 2 bright lavender bags.
plaid olive bags contain 3 shiny crimson bags, 4 vibrant coral bags.
muted salmon bags contain 2 wavy gold bags, 3 drab silver bags, 3 clear maroon bags.
posh white bags contain 2 posh magenta bags, 4 dotted gray bags, 3 light red bags.
vibrant red bags contain 3 drab blue bags, 4 dark green bags, 2 dotted olive bags, 3 muted teal bags.
clear coral bags contain 3 faded crimson bags, 5 striped lime bags, 4 dull green bags, 3 shiny indigo bags.
dark gold bags contain 1 posh crimson bag.
dim gold bags contain 4 mirrored yellow bags.
mirrored teal bags contain 4 wavy indigo bags, 4 bright lavender bags.
mirrored maroon bags contain 5 posh chartreuse bags, 4 mirrored yellow bags, 4 striped tan bags, 2 shiny green bags.
drab orange bags contain 2 dark chartreuse bags.
wavy maroon bags contain 3 faded gold bags, 5 bright crimson bags, 5 mirrored brown bags.
clear indigo bags contain 3 dull tomato bags, 2 striped magenta bags, 1 plaid silver bag.
striped aqua bags contain 2 clear blue bags, 4 shiny tan bags, 3 bright beige bags, 3 muted plum bags.
faded blue bags contain 1 wavy tomato bag, 2 striped tomato bags, 2 muted chartreuse bags.
vibrant cyan bags contain 1 vibrant maroon bag, 5 wavy yellow bags.
dull gray bags contain 2 shiny gold bags, 2 dark violet bags, 2 muted blue bags, 1 plaid silver bag.
drab magenta bags contain 1 dull indigo bag, 1 dark black bag.
clear crimson bags contain 4 vibrant chartreuse bags, 1 vibrant tomato bag, 2 bright blue bags, 3 faded blue bags.
light cyan bags contain 1 striped yellow bag, 2 shiny olive bags, 2 dim beige bags.
light gold bags contain 2 posh tomato bags, 3 dark tomato bags, 4 posh fuchsia bags, 4 light tomato bags.
drab olive bags contain 4 pale cyan bags, 1 dark chartreuse bag, 5 vibrant salmon bags, 1 posh olive bag.
dark black bags contain 1 clear gray bag, 2 dull crimson bags.
bright red bags contain 4 mirrored blue bags, 1 muted blue bag.
shiny purple bags contain 3 pale coral bags, 2 pale gray bags.
pale cyan bags contain 4 bright lavender bags.
plaid brown bags contain 2 dotted plum bags, 4 striped tan bags, 2 dotted salmon bags, 4 posh magenta bags.
wavy indigo bags contain 3 clear turquoise bags, 4 drab bronze bags, 3 shiny tan bags, 4 plaid turquoise bags.
light teal bags contain 2 mirrored tomato bags, 5 muted silver bags, 5 dotted white bags.
dotted aqua bags contain 2 dim gold bags, 1 dull red bag, 4 faded yellow bags, 2 muted blue bags.
posh indigo bags contain 3 dull indigo bags, 2 dotted turquoise bags, 5 shiny plum bags.
dull tan bags contain 2 clear gray bags, 1 striped tomato bag.
dark violet bags contain 2 drab bronze bags, 2 striped turquoise bags, 3 striped lavender bags, 5 dotted turquoise bags.
dark teal bags contain 2 bright silver bags, 3 mirrored teal bags, 5 faded chartreuse bags, 1 pale lavender bag.
bright beige bags contain 1 faded white bag, 3 light bronze bags.
wavy crimson bags contain 3 drab white bags, 4 drab bronze bags, 5 wavy white bags.
striped teal bags contain 2 light silver bags, 3 dotted turquoise bags, 4 muted maroon bags.
striped gray bags contain 1 striped white bag, 4 dark purple bags.
plaid aqua bags contain 5 pale maroon bags.
bright brown bags contain 3 faded silver bags, 5 shiny yellow bags, 1 dull olive bag.
dotted lime bags contain 5 light magenta bags, 1 faded magenta bag, 4 wavy olive bags.
posh fuchsia bags contain 5 dark violet bags, 4 drab bronze bags, 4 striped lavender bags.
shiny bronze bags contain 4 dotted gray bags, 2 striped bronze bags, 5 plaid beige bags.
clear tan bags contain 1 pale red bag.
bright maroon bags contain 5 dark brown bags, 5 mirrored lavender bags.
wavy green bags contain 2 drab lavender bags, 2 posh gray bags.
mirrored green bags contain 5 dull gold bags, 3 plaid silver bags, 5 dark blue bags, 1 shiny orange bag.
striped plum bags contain 1 mirrored blue bag, 5 drab coral bags.
muted tan bags contain 5 light coral bags.
wavy purple bags contain 4 muted yellow bags, 1 shiny indigo bag.
mirrored fuchsia bags contain 1 shiny yellow bag, 3 dim purple bags, 5 muted cyan bags.
bright violet bags contain 5 dotted crimson bags, 2 dull olive bags, 4 pale salmon bags, 1 dim indigo bag.
mirrored magenta bags contain 1 light indigo bag, 3 bright plum bags, 1 faded coral bag, 3 posh blue bags.
light green bags contain 1 dark lavender bag.
shiny plum bags contain no other bags.
posh magenta bags contain 4 plaid bronze bags.
faded olive bags contain 4 light indigo bags.
vibrant plum bags contain 3 posh yellow bags, 4 pale yellow bags, 4 plaid lime bags.
posh yellow bags contain 1 shiny plum bag, 1 light chartreuse bag.
clear black bags contain 1 muted plum bag, 4 dull olive bags.
striped tan bags contain 2 bright lavender bags, 2 clear beige bags.
dotted yellow bags contain 3 dull blue bags, 1 dim beige bag, 2 faded coral bags, 4 plaid yellow bags.
muted black bags contain 4 mirrored plum bags.
plaid turquoise bags contain 5 shiny olive bags, 1 striped yellow bag.
striped purple bags contain 4 striped tomato bags, 3 plaid silver bags.
light yellow bags contain 5 light salmon bags, 4 mirrored tomato bags.
wavy bronze bags contain 4 pale turquoise bags, 1 striped olive bag, 4 dotted lime bags.
bright gold bags contain 2 shiny gray bags, 3 dark green bags, 1 pale chartreuse bag, 3 dull aqua bags.
dull beige bags contain 5 vibrant salmon bags.
muted turquoise bags contain 4 wavy olive bags, 3 faded coral bags.
dotted fuchsia bags contain 5 mirrored salmon bags, 2 muted plum bags, 3 plaid brown bags, 5 mirrored black bags.
posh turquoise bags contain 1 vibrant lime bag, 3 dim orange bags.
plaid indigo bags contain 1 faded blue bag, 4 bright teal bags, 4 clear green bags.
mirrored lime bags contain 5 posh magenta bags, 2 mirrored lavender bags, 5 dull bronze bags, 2 dim cyan bags.
dull magenta bags contain 1 light bronze bag, 2 dark tan bags, 4 bright salmon bags, 4 drab aqua bags.
shiny crimson bags contain 2 bright plum bags, 1 faded bronze bag, 2 striped purple bags, 2 dull blue bags.
vibrant crimson bags contain 4 bright plum bags, 1 vibrant orange bag.
muted red bags contain 5 clear beige bags, 2 striped crimson bags, 1 light orange bag, 2 striped turquoise bags.
light purple bags contain 4 wavy tomato bags, 2 mirrored orange bags, 3 dim beige bags, 5 striped tan bags.
vibrant indigo bags contain 3 clear gold bags, 5 shiny black bags.
drab turquoise bags contain 2 dull maroon bags, 1 pale salmon bag.
dotted tan bags contain 2 pale silver bags.
faded purple bags contain 1 posh green bag, 1 posh black bag, 2 wavy lavender bags.
dull lime bags contain 3 dull gray bags, 4 light orange bags.
dotted blue bags contain 4 dark plum bags, 4 light salmon bags, 3 dim white bags.
wavy violet bags contain 5 wavy plum bags, 1 light fuchsia bag, 4 pale salmon bags, 2 drab fuchsia bags.
shiny magenta bags contain 3 wavy indigo bags, 5 drab salmon bags, 4 dull beige bags, 3 faded beige bags.
dull silver bags contain 1 mirrored turquoise bag, 5 dim white bags.
dark purple bags contain 1 plaid chartreuse bag, 4 posh black bags, 2 dark violet bags, 4 posh gray bags.
bright turquoise bags contain 4 dim bronze bags, 4 wavy plum bags, 4 drab salmon bags.
dark chartreuse bags contain 1 light orange bag.
shiny fuchsia bags contain 3 shiny bronze bags, 5 shiny gold bags, 3 pale lavender bags.
wavy silver bags contain 1 muted orange bag, 5 faded turquoise bags.
vibrant salmon bags contain 2 dim beige bags, 2 posh magenta bags.
dim beige bags contain 5 dim purple bags, 4 plaid blue bags, 3 dull maroon bags, 1 shiny olive bag.
muted cyan bags contain 3 clear gray bags.
plaid silver bags contain no other bags.
dotted white bags contain 1 dim purple bag, 2 dull gold bags.
pale orange bags contain 3 clear aqua bags.
dull white bags contain 5 light green bags, 3 posh fuchsia bags.
shiny red bags contain 4 drab bronze bags, 2 striped yellow bags, 1 shiny olive bag, 2 striped lavender bags.
pale blue bags contain 4 pale magenta bags.
light fuchsia bags contain 2 dotted turquoise bags, 5 striped crimson bags.
light maroon bags contain 5 dotted maroon bags, 3 posh blue bags, 5 faded gray bags.
dull purple bags contain 4 posh teal bags, 2 vibrant plum bags, 3 vibrant gray bags.
pale indigo bags contain 5 plaid fuchsia bags, 3 dull violet bags, 1 posh maroon bag, 5 muted silver bags.
dull violet bags contain 4 muted gray bags, 5 posh indigo bags, 2 bright violet bags.
pale turquoise bags contain 3 vibrant brown bags.
mirrored brown bags contain 1 dotted magenta bag, 2 striped lavender bags.
dotted black bags contain 4 dull lime bags, 5 posh white bags, 1 plaid plum bag, 2 bright lime bags.
mirrored white bags contain 3 faded brown bags, 3 shiny gray bags, 1 striped plum bag.
dotted gray bags contain 2 shiny lavender bags, 1 light white bag, 2 vibrant salmon bags.
vibrant gray bags contain 2 posh silver bags, 3 muted silver bags, 2 muted gray bags, 1 pale white bag.
striped blue bags contain 1 dim silver bag.
muted bronze bags contain 1 dim lavender bag, 3 striped bronze bags.
wavy orange bags contain 4 light bronze bags.
faded salmon bags contain 1 clear turquoise bag, 5 plaid violet bags, 5 plaid blue bags, 3 wavy green bags.
vibrant green bags contain 1 striped beige bag, 4 bright green bags, 1 shiny salmon bag.
posh lavender bags contain 1 dotted violet bag, 4 dim white bags, 5 faded lavender bags.
pale magenta bags contain 1 muted red bag.
light salmon bags contain 1 mirrored tomato bag.
shiny teal bags contain 5 dull fuchsia bags.
muted chartreuse bags contain 3 dull beige bags, 2 striped magenta bags, 3 clear beige bags, 4 plaid plum bags.
dull olive bags contain 5 light chartreuse bags, 3 muted cyan bags, 2 dull brown bags, 1 muted gray bag.
shiny tan bags contain 1 drab plum bag, 1 vibrant aqua bag, 5 striped bronze bags.
dim tomato bags contain 1 vibrant lavender bag, 5 light cyan bags, 5 dull indigo bags, 3 vibrant chartreuse bags.
drab gold bags contain 3 muted olive bags, 3 plaid purple bags.
clear red bags contain 5 vibrant white bags.
mirrored tomato bags contain 1 dim purple bag, 5 posh fuchsia bags, 3 striped turquoise bags, 2 posh gray bags.
faded crimson bags contain 4 dark olive bags, 3 dull bronze bags, 4 faded blue bags, 4 wavy chartreuse bags.
faded indigo bags contain 4 vibrant lavender bags.
pale plum bags contain 1 posh lavender bag, 2 dotted gold bags, 1 bright magenta bag, 4 dull gray bags.
plaid plum bags contain 2 posh fuchsia bags, 5 bright lime bags, 2 vibrant gold bags, 2 muted gray bags.
bright tan bags contain 3 dotted magenta bags.
vibrant turquoise bags contain 3 wavy green bags, 4 striped tomato bags, 1 striped magenta bag.
wavy salmon bags contain 4 vibrant lavender bags, 4 clear turquoise bags, 5 striped magenta bags.
dark gray bags contain 3 striped blue bags.
posh gold bags contain 2 pale purple bags.
muted coral bags contain 2 mirrored brown bags, 1 muted blue bag.
dark turquoise bags contain 3 dark olive bags, 5 faded indigo bags.
faded tomato bags contain 2 wavy brown bags, 4 drab silver bags, 1 dotted turquoise bag.
clear teal bags contain 1 striped tan bag, 2 clear aqua bags, 4 dark purple bags.
plaid purple bags contain 5 vibrant tan bags, 1 muted coral bag.
faded red bags contain 4 striped salmon bags, 4 pale lime bags, 3 posh bronze bags.
mirrored cyan bags contain 5 plaid maroon bags, 2 light fuchsia bags, 1 striped white bag, 1 dotted green bag.
dull yellow bags contain 3 light orange bags.
vibrant tan bags contain 3 plaid plum bags, 5 light orange bags, 2 dotted orange bags, 5 vibrant lime bags.
dim white bags contain 4 posh indigo bags, 4 dark aqua bags, 1 drab lavender bag.
drab silver bags contain 5 posh indigo bags, 2 striped crimson bags, 1 striped yellow bag, 2 shiny olive bags.
mirrored red bags contain 5 plaid maroon bags, 3 shiny beige bags, 1 mirrored bronze bag.
dull maroon bags contain no other bags.
shiny tomato bags contain 4 muted maroon bags, 3 dotted lime bags, 3 faded green bags, 1 wavy plum bag.
dotted brown bags contain 1 mirrored coral bag, 2 dotted coral bags, 4 vibrant aqua bags.
drab coral bags contain 5 vibrant black bags, 5 mirrored tomato bags, 4 wavy gray bags, 3 drab orange bags.
dull indigo bags contain 2 plaid blue bags, 2 striped crimson bags, 1 dull brown bag.
dull red bags contain 5 drab fuchsia bags, 2 posh gray bags, 3 shiny brown bags, 1 plaid violet bag.
pale silver bags contain 5 plaid beige bags, 3 dim cyan bags, 3 light tan bags, 3 faded bronze bags.
wavy blue bags contain 4 drab gray bags, 4 mirrored olive bags.
clear salmon bags contain 2 light brown bags, 2 bright yellow bags, 5 light blue bags, 3 faded bronze bags.
drab brown bags contain 2 mirrored chartreuse bags, 4 bright tomato bags.
dotted purple bags contain 2 dotted yellow bags, 4 vibrant white bags.
dark yellow bags contain 2 faded coral bags, 1 muted red bag.
shiny turquoise bags contain 3 pale coral bags.
vibrant silver bags contain no other bags.
shiny silver bags contain 2 dim gold bags, 1 dim silver bag.
clear beige bags contain 4 striped crimson bags.
bright lime bags contain 4 light cyan bags, 2 wavy plum bags, 2 light green bags.
vibrant yellow bags contain 5 dark salmon bags, 5 dull green bags, 3 light silver bags.
dotted beige bags contain 1 wavy brown bag, 1 dull violet bag, 4 dull beige bags, 1 dull crimson bag.
dim coral bags contain 2 vibrant olive bags.
faded bronze bags contain 4 dull maroon bags, 4 posh indigo bags, 3 drab white bags, 5 dotted magenta bags.
light lime bags contain 4 mirrored violet bags, 5 posh turquoise bags, 1 mirrored tomato bag.
clear orange bags contain 3 bright cyan bags, 2 light blue bags, 2 dull indigo bags.
dim crimson bags contain 2 dark white bags, 5 dotted yellow bags, 4 clear tomato bags, 2 drab purple bags.
dark bronze bags contain 3 drab magenta bags, 3 clear aqua bags.
wavy teal bags contain 1 pale violet bag, 1 muted lavender bag, 2 dull brown bags, 4 mirrored purple bags.
dim silver bags contain 5 faded gold bags, 4 faded purple bags, 3 dim beige bags, 2 faded gray bags.
plaid chartreuse bags contain 4 striped lavender bags, 3 muted plum bags, 1 dim beige bag.
bright coral bags contain 4 dotted orange bags, 5 dotted gold bags, 1 mirrored salmon bag, 4 dark tan bags.
striped indigo bags contain 2 striped yellow bags, 1 dark aqua bag, 1 dull silver bag.
shiny beige bags contain 4 dark green bags, 1 muted gray bag.
drab salmon bags contain 1 clear purple bag, 5 light cyan bags, 4 dim purple bags.
posh salmon bags contain 3 dotted tomato bags, 5 wavy salmon bags, 1 striped lime bag.
clear maroon bags contain 3 muted red bags, 2 light bronze bags, 5 dark chartreuse bags.
clear purple bags contain 1 plaid coral bag, 2 dim lime bags, 4 dull aqua bags.
clear cyan bags contain 3 drab beige bags, 3 vibrant tan bags, 3 bright lime bags, 4 dim salmon bags.
plaid crimson bags contain 5 dark coral bags, 1 vibrant lime bag, 5 dotted beige bags.
striped chartreuse bags contain 2 vibrant white bags, 1 shiny bronze bag, 3 light olive bags.
clear blue bags contain 2 dim cyan bags, 1 bright lavender bag, 2 posh green bags.
striped olive bags contain 2 light plum bags, 2 dark red bags.
plaid red bags contain 2 vibrant violet bags, 4 dotted orange bags, 1 dark aqua bag, 5 dim green bags.
mirrored orange bags contain 1 plaid turquoise bag, 3 pale chartreuse bags.
wavy coral bags contain 4 clear maroon bags, 4 mirrored yellow bags, 3 plaid bronze bags.
posh orange bags contain 1 posh yellow bag, 3 muted purple bags, 3 striped turquoise bags.
light aqua bags contain 2 clear turquoise bags, 3 posh black bags, 5 dotted indigo bags, 4 striped magenta bags.
plaid coral bags contain 4 wavy gold bags.
pale green bags contain 2 shiny tan bags, 3 mirrored olive bags, 4 light purple bags, 5 drab maroon bags.
dull bronze bags contain 4 faded salmon bags, 2 plaid violet bags, 1 shiny salmon bag.
dull tomato bags contain 5 clear gray bags, 2 shiny tan bags, 3 dark cyan bags, 4 dim chartreuse bags.
faded maroon bags contain 5 dim green bags, 1 dull coral bag, 5 muted green bags.
dark fuchsia bags contain 3 clear silver bags.
striped yellow bags contain 5 plaid beige bags, 5 drab bronze bags, 1 muted cyan bag, 1 plaid silver bag.
muted white bags contain 3 light bronze bags.
wavy tan bags contain 2 dim cyan bags, 4 plaid lime bags.
pale coral bags contain 2 posh magenta bags, 2 striped green bags, 2 dotted bronze bags.
mirrored blue bags contain 4 light plum bags, 2 wavy cyan bags.
faded plum bags contain 5 faded salmon bags, 4 vibrant violet bags.
vibrant teal bags contain 3 drab plum bags.
dotted red bags contain 2 dim white bags, 2 mirrored purple bags.
plaid salmon bags contain 2 posh chartreuse bags, 5 shiny maroon bags, 1 faded indigo bag.
wavy fuchsia bags contain 1 bright cyan bag, 5 pale violet bags, 5 muted maroon bags.
light red bags contain 4 muted cyan bags, 5 wavy lavender bags, 5 muted blue bags.
dark magenta bags contain 4 vibrant green bags.
bright purple bags contain 2 muted blue bags.
dotted gold bags contain 3 muted gray bags, 5 mirrored salmon bags.
striped red bags contain 2 wavy violet bags, 1 dark aqua bag.
light crimson bags contain 4 drab plum bags, 3 dark chartreuse bags, 3 dotted gray bags, 2 clear white bags.
bright black bags contain 2 shiny orange bags, 3 wavy tan bags, 3 shiny yellow bags.
striped silver bags contain 4 striped gray bags, 2 clear black bags, 5 shiny cyan bags.
plaid blue bags contain 2 striped crimson bags, 1 clear gray bag.
light gray bags contain 1 muted blue bag, 5 shiny plum bags.
mirrored gray bags contain 2 light green bags.
vibrant orange bags contain 5 dim green bags.
posh bronze bags contain 1 posh white bag, 3 dotted green bags.
faded orange bags contain 3 pale lime bags, 5 bright lavender bags, 5 faded green bags, 1 wavy gray bag.
faded lime bags contain 5 wavy salmon bags, 2 dim white bags, 4 drab white bags.
bright salmon bags contain 1 dotted white bag.
dim turquoise bags contain 5 muted turquoise bags.
dark maroon bags contain 3 striped magenta bags.
dim violet bags contain 5 dim white bags, 4 clear chartreuse bags.
vibrant violet bags contain 5 light gray bags, 2 wavy aqua bags.
dim fuchsia bags contain 3 vibrant white bags, 1 pale beige bag.
drab fuchsia bags contain 4 dotted turquoise bags, 1 dull crimson bag, 5 plaid violet bags.
dim purple bags contain 1 plaid silver bag, 4 posh gray bags, 2 plaid beige bags.
mirrored lavender bags contain 4 vibrant lime bags, 1 vibrant violet bag, 5 mirrored aqua bags, 4 clear black bags.
posh green bags contain no other bags.
faded tan bags contain 3 faded fuchsia bags, 4 dull bronze bags.
drab cyan bags contain 4 mirrored teal bags, 1 light turquoise bag, 4 faded blue bags, 5 clear black bags.
light chartreuse bags contain 5 posh gray bags.
striped fuchsia bags contain 1 dotted beige bag, 1 shiny magenta bag, 4 mirrored indigo bags, 3 wavy yellow bags.
light white bags contain 5 muted purple bags, 4 dark lavender bags, 1 wavy violet bag, 3 vibrant aqua bags.
dotted lavender bags contain 2 vibrant magenta bags, 3 plaid turquoise bags, 2 posh crimson bags, 2 bright tan bags.
faded yellow bags contain 1 pale olive bag, 4 plaid bronze bags.
plaid gold bags contain 4 dull gold bags, 4 drab crimson bags, 1 shiny brown bag.
dark aqua bags contain 4 shiny gold bags, 1 striped magenta bag, 4 striped tomato bags.
vibrant gold bags contain 4 dull indigo bags.";
}
