<?php
	class Block
	{
		protected $_plaintext = "";
		
		protected $_plaintext_selection = "";
		
		
		public function __construct( string $plaintext = "" )
		{
			if( ! $plaintext )
			{
				throw new Exception('no plaintext specified');
			}
			
			$plaintext = str_pad($plaintext, 64);
			
			$this->_plaintext = $plaintext;
		}
		
		public function debug_plaintext_binary()
		{
			$output_string = '';
			
			for( $i = 0; $i < strlen($this->_plaintext); $i++ )
			{
				$output_string .= ($output_string)
					? ' '
					: '';
				
				$output_string .= decbin(ord(substr($this->_plaintext, $i, 1)));
			}
			
			return $output_string;
		}
		
		public function debug_plaintext_decimal()
		{
			$output_string = '';
			
			for( $i = 0; $i < strlen($this->_plaintext); $i++ )
			{
				$output_string .= ($output_string)
					? ' '
					: '';
				
				$output_string .= ord(substr($this->_plaintext, $i, 1));
			}
			
			return $output_string;
		}
		
		public function plaintext()
		{
			return $this->_plaintext;
		}
		
	}
