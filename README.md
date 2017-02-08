Note: configurable operation mapping acts as personal keyset with combinatorial scheme for creating nonce operation maps

Note: minimum square size 1024b/64B ASCII

1st and 2nd/permutations (ASCII character value % 16)

Note: simplified to “select all” (no permutation implementation) for debug/prototyping

Selections

0000 select all
0010 select every 3rd
0011 bisect horizontal and select left
0100 bisect horizontal and select right
0101 bisect vertical and select top
0110 bisect vertical and select bottom
0111 quadrants select top/left
1000 quadrants select top/right
1001 quadrants select bottom/left
1010 quadrants select bottom/right
1011 columns select every odd
1100 columns select every even
1101 rows select every odd
1111 rows select every even

Mutations

0000-0111 bitwise flip bits
1000 bitwise shift bit right
1010 bitwise shift bit left
1011 bitwise shift bit up
1100 bitwise shift bit down
1101 tinyint increment 1 (zero if > 256)
1110 tinyint decrement 1 (max if < 0)
1111 tinyint increment 9 (zero if > 256)

TODO: Implement prototype, confirm working symmetric encryption, test output randomness for arbitrary number of permutation cycles
