<?php
	class Block
	{
		protected $_binarystring = "";
		
		protected $_map_selection = array(
			'0000'	=> array('select_all'),
			'0001'	=> array('select_ordinal', 3),
			'0010'	=> array('select_ordinal', 5),
			'0011'	=> array('select_ordinal', 7),
			'0100'	=> array('select_ordinal', 11),
			'0101'	=> array('select_ordinal', 19),
			'0110'	=> array('select_ordinal', 23),
			'0111'	=> array('select_half', 0),
			'1000'	=> array('select_half', 1),
			'1001'	=> array('select_quarter', 0),
			'1010'	=> array('select_quarter', 1),
			'1011'	=> array('select_quarter', 2),
			'1100'	=> array('select_quarter', 3),
			'1101'	=> array('select_quarters', array(0,2)),
			'1110'	=> array('select_quarters', array(1,3)),
			'1111'	=> array('select_all'),
		);
		
		protected $_map_mutation = array(
			'0000'	=> array('', 1234),
			'0001'	=> array('', 1234),
			'0010'	=> array('', 1234),
			'0011'	=> array('', 1234),
			'0100'	=> array('', 1234),
			'0101'	=> array('', 1234),
			'0110'	=> array('', 1234),
			'0111'	=> array('', 1234),
			'1000'	=> array('', 1234),
			'1001'	=> array('', 1234),
			'1010'	=> array('', 1234),
			'1011'	=> array('', 1234),
			'1100'	=> array('', 1234),
			'1101'	=> array('', 1234),
			'1110'	=> array('', 1234),
			'1111'	=> array('', 1234),
		);
		
		protected $_plaintext = "";
		
		public function __construct( string $plaintext = "" )
		{
			if( ! $plaintext )
			{
				throw new Exception('no plaintext specified');
			}
			
			$this->_plaintext = $plaintext;
			
			$this->_binarystring = $this->to_binarystring($this->_plaintext);
		}
		
		
		/**
		 * binarystring (ASCII representation of binary contents)
		 */
		public function binarystring()
		{
			return $this->_binarystring;
		}
		
		
		/**
		 * print-formatted output
		 */
		public function binarystring_debug( $input_string = null )
		{
			if( ! $input_string )
				$input_string = $this->_binarystring;
			
			$output_string = '';
			
			for( $i = 0; $i < ( strlen($input_string) / 4 ); $i++ )
			{
				$output_string .= ( !( $i % 8 ) )
					? "\n"
					: '';
				
				$output_string .= ( $output_string )
					? ' '
					: '';
				
				$output_string .= substr($input_string, ($i * 4), 4);
			}
			
			return $output_string;
		}
		
		
		/**
		 * generate ASCII from binary string
		 */
		public function binarystring_to_ascii()
		{
			return $this->to_ascii( $this->_binarystring );
		}
		
		
		/**
		 * merge results from Selection methods
		 */
		public function merge( $selection_results = array() )
		{
			$binarystring = $selection_results['original'];
			
			$changes = $selection_results['selected'];
			
			$changes_accepted = 0;
			
			$result = '';
			
			for( $i = 0; $i < strlen($binarystring); $i++ )
			{
				if( 'X' != substr($binarystring, $i, 1) )
				{
					$result .= substr($binarystring, $i, 1);
					continue;
				}
				
				$result .= $changes[$changes_accepted];
				
				$changes_accepted++;
			}
			
			return $result;
		}
		
		
		/**
		 * mutate iter times, producing initial selection and mutation numbers and
		 *  changing contents of binarystring
		 */
		public function mutate( $iterations = 64 )
		{
			$changes = array();
			
			for( $iteration = 0; $iteration < $iterations; $iteration++ )
			{
				$selection = substr($this->_binarystring, 0, 4);
				
				$mutation = substr($this->_binarystring, (strlen($this->_binarystring)-4), 4);
				
				$changes[$iteration] = array(
					'selection'	=> $selection,
					'mutation'	=> $mutation,
				);
				
				$selection = new Selection($this->_binarystring, $selection, $mutation);
				
				$this->_binarystring = $selection->encode();
				
				// TODO: complete, test implementation
			}
		}
		
		
		/**
		 * convert binary string to ASCII
		 */
		public function to_ascii( $input_string = '' )
		{
			if( ! $input_string )
				throw new Exception('missing input string');
			
			if( preg_match( '/[^0-1]/', $input_string ) )
				throw new Exception('input string is not binary (invalid character)');
			
			if( strlen($input_string) % 8 )
				throw new Exception('input string is not binary (not enough bits)');
			
			$output_string = '';
			
			for( $i = 0; $i < ( strlen($input_string) / 8 ); $i++ )
			{
				$output_string .= chr( base_convert(substr($input_string, ($i * 8), 8), 2, 10) );
			}
			
			return $output_string;
		}
		
		
		/**
		 * convert ASCII to binary string (ughly but accomplishes idea)
		 */
		public function to_binarystring( $input_string = '' )
		{
			$output_string = '';
			
			for( $i = 0; $i < strlen($input_string); $i++ )
			{
				$output_string .= str_pad(base_convert(ord(substr($input_string, $i, 1)), 10, 2), 8, '0', STR_PAD_LEFT );
			}
			
			return $output_string;
		}
		
		
	}
