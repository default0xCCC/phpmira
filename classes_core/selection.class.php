<?php
	class Selection
	{
		protected $_operator = null;
		
		protected $_text = null;
		
		
		public function __construct( $operator, $plaintext )
		{
			$this->_operator = $operator % 16;
			
			switch( $operator )
			{
				case 0:
				case 1:
				case 2:
				case 3:
					$this->_text = $plaintext;
				break;
				case 4:
				case 6:
					for( $i = 0; $i < strlen($plaintext) / 2; $i++ )
					{
						$this->_text .= substr($plaintext, ($i * 2), 1);
					}
				break;
				case 7:
				case 5:
					for( $i = 0; $i < strlen($plaintext) / 4; $i++ )
					{
						$this->_text .= substr($plaintext, ($i * 4), 1);
					}
				break;
				case 8:
					for( $i = 0; $i < strlen($plaintext); $i++ )
					{
						if( ($i % 8) > 3 )
							continue;
						$this->_text .= substr($plaintext, $i, 1);
					}
				break;
				case 9:
					for( $i = 0; $i < strlen($plaintext); $i++ )
					{
						if( ($i % 8) < 4 )
							continue;
						$this->_text .= substr($plaintext, $i, 1);
					}
				break;
				case 10:
					for( $i = 0; $i < strlen($plaintext) / 2; $i++ )
					{
						$this->_text .= substr($plaintext, $i, 1);
					}
				break;
				case 11:
					for( $i = 0; $i < strlen($plaintext) / 2; $i++ )
					{
						$this->_text .= substr($plaintext, (strlen($plaintext) / 2) + $i, 1);
					}
				break;
				case 12:
					for( $i = 0; $i < strlen($plaintext) / 2; $i++ )
					{
						if( ($i % 8) > 3 )
							continue;
						$this->_text .= substr($plaintext, $i, 1);
					}
				break;
				case 13:
					for( $i = 0; $i < strlen($plaintext) / 2; $i++ )
					{
						if( ($i % 8) < 4 )
							continue;
						$this->_text .= substr($plaintext, $i, 1);
					}
				break;
				case 14:
					for( $i = 0; $i < strlen($plaintext) / 2; $i++ )
					{
						if( ($i % 8) < 4 )
							continue;
						$this->_text .= substr($plaintext, (strlen($plaintext) / 2) + $i, 1);
					}
				break;
				case 15:
					for( $i = 0; $i < strlen($plaintext) / 2; $i++ )
					{
						if( ($i % 8) > 3 )
							continue;
						$this->_text .= substr($plaintext, (strlen($plaintext) / 2) + $i, 1);
					}
				break;
			/*
				0.12 quadrants select top/left
				0.13 quadrants select top/right
				0.14 quadrants select bottom/left
				0.15 quadrants select bottom/right
			*/
				case 12:
				break;
				case 13:
				break;
				case 14:
				break;
				case 15:
				break;
				default:
					throw new Exception('invalid operator "'.$plaintext_operator.'"/'.$this->_operator);
				break;
			}
		}
		
		public function debug_plaintext()
		{
			return $this->_text;
		}
		
	}
