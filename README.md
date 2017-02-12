Note: configurable operation mapping acts as personal keyset with combinatorial scheme for creating nonce operation maps

Selections

0000 select all
0001 select every 3rd
0010 select every 5th
0011 select every 7th
0100 select every 11th
0101 select every 19th
0110 select every 23rd
0111 bisect and select left
1000 bisect and select right
1001 4th's and select 1st
1010 4th's and select 2nd
1011 4th's and select 3rd
1100 4th's and select 4th
1101 4th's and select 1st and 3rd
1110 4th's and select 2nd and 4th
1111 select all

Mutations

Note: these could be randomly generated (set up to avoid rule collisions when operating on simplest selection spaces)

0000 shift left 3
0010 shift left 5
0011 shift left 7
0100 shift left 11
0101 shift left 19
0110 shift left 27
0111 shift left 31
1000 shift right 2 (-2)
1001 shift right 6 (-6)
1010 shift right 10 (-10)
1011 shift right 18 (-18)
1100 shift right 23 (-23)
1101 shift right 26 (-26)
1111 shift right 29 (-29)

TODO: Implement prototype, confirm working symmetric encryption, test output randomness for arbitrary number of permutation cycles
