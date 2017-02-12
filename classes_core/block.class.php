<?php
	class Block
	{
		protected $_input = "";
		
		protected $_map_selection = array(
			'0000'	=> array('select_ordinal', 1),
			'0001'	=> array('select_ordinal', 2),
			'0010'	=> array('select_ordinal', 3),
			'0011'	=> array('select_ordinal', 4),
			'0100'	=> array('select_ordinal', 5),
			'0101'	=> array('select_ordinal', 6),
			'0110'	=> array('select_ordinal', 7),
			'0111'	=> array('select_half', 0),
			'1000'	=> array('select_half', 1),
			'1001'	=> array('select_quarter', 0),
			'1010'	=> array('select_quarter', 1),
			'1011'	=> array('select_quarter', 2),
			'1100'	=> array('select_quarter', 3),
			'1101'	=> array('select_quarters', array(0,2)),
			'1110'	=> array('select_quarters', array(1,3)),
			'1111'	=> array('select_ordinal', 1),
		);
		
		protected $_map_shift = array(
			'0000'	=> array('mutate_shift', 1),
			'0001'	=> array('mutate_shift', 2),
			'0010'	=> array('mutate_shift', 3),
			'0011'	=> array('mutate_shift', 4),
			'0100'	=> array('mutate_shift', 5),
			'0101'	=> array('mutate_shift', 6),
			'0110'	=> array('mutate_shift', 7),
			'0111'	=> array('mutate_shift', 8),
			'1000'	=> array('mutate_shift', -1),
			'1001'	=> array('mutate_shift', -2),
			'1010'	=> array('mutate_shift', -3),
			'1011'	=> array('mutate_shift', -4),
			'1100'	=> array('mutate_shift', -5),
			'1101'	=> array('mutate_shift', -6),
			'1110'	=> array('mutate_shift', -7),
			'1111'	=> array('mutate_shift', -8),
		);
		
		protected $_mode = 'password';
		
		protected $_number = 0;
		
		protected $_operation = 'encode';
		
		protected $_password = '';
		
		
		public function __construct( $options_cli = array() )
		{
			// TODO: handle file as input
			if( ! $options_cli['input'] )
				throw new Exception('missing input');
			
			switch( true )
			{
				case ( ! $options_cli['number'] ):
				case ( ! is_numeric($options_cli['number']) ):
					throw new Exception('missing/invalid number of iterations');
				break;
				case ( $options_cli['number'] < 64 ):
					throw new Exception('number of iterations must be greater than 64');
				break;
				default:
					// acceptable
				break;
			}
			$this->_number = $options_cli['number'];
		
			switch( $options_cli['operation'] )
			{
				case 'decode':
					// TODO
					throw new Exception('not implemented');
				case 'encode':
					// valid
				break;
				case '':
					throw new Exception('operation not set');
				break;
				default:
					throw new Exception('option specified not valid');
				break;
			}
			
			switch( $options_cli['mode'] )
			{
				case 'password':
					if( ! $options_cli['password'] )
						throw new Exception('missing password');
				break;
				case '':
					throw new Exception('mode not set');
				break;
				default:
					throw new Exception('option specified not valid');
				break;
			}
			
			// TODO: handle password file
			$this->_password = $options_cli['password'];
			
			$this->_input = $this->to_binarystring($options_cli['input']);
		}
		
		
		/**
		 * binarystring (ASCII representation of binary contents)
		 */
		public function binarystring()
		{
			return $this->_input;
		}
		
		
		/**
		 * print-formatted output
		 */
		public function binarystring_debug( $input_string = null )
		{
			if( ! $input_string )
				$input_string = $this->_input;
			
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
			return $this->to_ascii( $this->_input );
		}
		
		
		/**
		 * merge results from Selection methods
		 */
		public function merge( $selection_results = array() )
		{
			if(
				! array_key_exists('original', $selection_results) ||
				! array_key_exists('selected', $selection_results)
			)
				throw new Exception('bad results: '.var_export($selection_results, 1));
			
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
		 * mutate iter times, producing initial selection and shift numbers and
		 *  changing contents of binarystring
		 */
		public function encode()
		{
			$iterations = $this->_number;
			
			$changes = array();
			
			if( $this->_mode == 'password' )
			{
				$password_nonce = $this->to_binarystring($this->_password);
			}
			
			for( $iteration = 0; $iteration < $iterations; $iteration++ )
			{
				switch( $this->_mode )
				{
					case 'password':
					default:
						$password_nonce_position = $iteration % strlen($this->_password);
						$selection = substr($password_nonce, ($password_nonce_position * 4), 4);
						$shift = substr($password_nonce, ($password_nonce_position * 4) + 4, 4);
					break;
				}
				
				$changes[$iteration] = array(
					'selection'	=> $selection,
					'shift'		=> $shift,
				);
				
				$fn = 'Selection::'.$this->_map_selection[$selection][0];
				
				$results = $fn($this->_input, $this->_map_selection[$selection][1]);
				
				$fn = 'Selection::'.$this->_map_shift[$selection][0];
				
				$results['selected'] = $fn($results['selected'], $this->_map_shift[$shift][1]);
				
				$this->_input = $this->merge($results);
				
				var_dump($this->_input);
			}
			
			var_dump(
				$this->_input
			);
			
			return true;
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
