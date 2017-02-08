<?php
	class Block
	{
		protected $_binarystring = "";
		
		protected $_plaintext = "";
		
		public function __construct( string $plaintext = "" )
		{
			if( ! $plaintext )
			{
				throw new Exception('no plaintext specified');
			}
			
			$plaintext = str_pad($plaintext, 64);
			
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
		public function binarystring_debug()
		{
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
