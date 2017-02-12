<?php
	class Selection
	{
		
		// TODO: comment
		public static function mutate_shift( $binarystring, $places = 0 )
		{
			if( $places == 0 )
				throw new Exception('invalid number of places specified');
			
			if( $places < 0 )
			{
				$places = $places * -1;
				
				$binarystring_concat = strrev($binarystring);
				
				while( strlen($binarystring_concat) < strlen($binarystring)+$places )
				{
					$binarystring_concat .= $binarystring;
				}
				
				$binarystring_after = '';
				
				for( $i = $places; $i < strlen($binarystring)+1; $i++ )
				{
					$binarystring_after .= substr($binarystring_concat, $i, 1);
				}
				
				return strrev($binarystring_after);
			}
			
			$binarystring_concat = $binarystring;
			
			while( strlen($binarystring_concat) < strlen($binarystring)+$places )
			{
				$binarystring_concat .= $binarystring;
			}
			
			$binarystring_after = '';
			
			for( $i = $places; $i < strlen($binarystring)+1; $i++ )
			{
				$binarystring_after .= substr($binarystring_concat, $i, 1);
			}
			
			return $binarystring_after;
		}
		
		// TODO: comment
		public static function select_all( $binarystring )
		{
			return array(
				'original' => str_repeat('X', strlen($binarystring)),
				'selected' => $binarystring,
			);
		}
		
		// TODO: comment
		public static function select_half( $binarystring, $half )
		{
			
			// TODO
		}
		
		
		// TODO: comment
		public static function select_ordinal( $binarystring, $position )
		{
			// TODO
		}
		
		// TODO: comment
		public static function select_quarter( $binarystring, $position )
		{
			// TODO
		}
		
		// TODO: comment
		public static function select_quarters( $binarystring, $positions )
		{
			// TODO
		}
		
		
	}
