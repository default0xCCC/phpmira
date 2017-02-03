Note: configurable operation mapping acts as personal keyset with combinatorial scheme for creating nonce operation maps

Note: minimum square size 1024b/64B ASCII

1st and 2nd/permutations (ASCII character value % 16)

Note: simplified to “select all” (no permutation implementation) for debug/prototyping

0.0-0.3 select all
0.4 select every 2nd/4th/8th/16th
0.5 bisect vertical and select left
0.6 bisect vertical and select right
0.7 bisect horizontal and select top
0.8 bisect horizontal and select bottom
0.9 quadrants select top/left
0.10 quadrants select top/right
0.11 quadrants select bottom/left
0.12 quadrants select bottom/right
0.13 select inner square
0.14 select outer border
0.15 draw grid and select corners

1st/bitwise (ASCII character value)

1.0-1.119 offset bits left x1-120
1.120-1.240 offset bits right x1-120
1.241-244 rotate clockwise x1-4
1.245-249 rotate counterclockwise x1-4
1.250 mirror horizontal
1.251 mirror vertical
1.252-255 XOR

2nd/ASCII (ASCII character value % 64)

2.0-2.14 offset characters left x1-15
2.15-2.30 offset bits right x1-15
2.31-2.35 rotate clockwise x1-4
2.36-2.40 rotate counterclockwise x1-4
2.41 mirror horizontal
2.42 mirror vertical
2.43-2.63 ???

TODO: Implement prototype, confirm working symmetric encryption, test output randomness for arbitrary number of permutation cycles
