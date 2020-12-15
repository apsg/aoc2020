<?php
namespace Tests\Feature;

use App\Days\Day10\Adapters;
use Tests\TestCase;

class Day10Test extends TestCase
{

    /** @test */
    public function it_parses_input()
    {
        // given
        $voltages = explode(PHP_EOL, static::SHORT);

        // when
        $adapters = new Adapters($voltages);

        // then
        dd($adapters);
    }

    /** @test */
    public function it_counts_differences_for_short_input()
    {// given
        $voltages = explode(PHP_EOL, static::SHORT);

        // when
        $adapters = (new Adapters($voltages))->process();

        // then
        $this->assertEquals(7, $adapters->dif1Count);
        $this->assertEquals(5, $adapters->dif3Count);
    }

    /** @test */
    public function it_counts_differences_for_medium_input()
    {// given
        $voltages = explode(PHP_EOL, static::MEDIUM);

        // when
        $adapters = (new Adapters($voltages))->process();

        // then
        $this->assertEquals(22, $adapters->dif1Count);
        $this->assertEquals(10, $adapters->dif3Count);
    }

    /** @test */
    public function it_counts_differences_for_long_input()
    {// given
        $voltages = explode(PHP_EOL, static::LONG);

        // when
        $adapters = (new Adapters($voltages))->process();

        // then
        $this->assertEquals(65, $adapters->dif1Count);
        $this->assertEquals(29, $adapters->dif3Count);
        $this->assertEquals(1885, $adapters->getDifferenceProduct());
    }

    const SHORT = '16
10
15
5
1
11
7
19
6
12
4';

    const MEDIUM = '28
33
18
42
31
14
46
20
48
47
24
23
49
45
19
38
39
11
1
32
25
35
8
17
7
9
4
2
34
10
3';

    const LONG = '80
87
10
122
57
142
134
59
113
139
101
41
138
112
46
96
43
125
36
54
133
17
42
98
7
114
78
67
77
28
149
58
20
105
31
19
18
27
40
71
117
66
21
72
146
90
97
94
123
1
119
30
84
61
91
118
2
29
104
73
13
76
24
148
68
111
131
83
49
8
132
9
64
79
124
95
88
135
3
51
39
6
60
108
14
35
147
89
34
65
50
145
128';
}
