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
					$binarystring_concat .= strrev($binarystring);
				}
				
				$binarystring_after = substr($binarystring_concat, $places, strlen($binarystring));
				
				return strrev($binarystring_after);
			}
			
			$binarystring_concat = $binarystring;
			
			while( strlen($binarystring_concat) < strlen($binarystring)+$places )
			{
				$binarystring_concat .= $binarystring;
			}
			
			$binarystring_after = substr($binarystring_concat, $places, strlen($binarystring));
			
			return $binarystring_after;
		}
		
		// TODO: comment
		public static function select_half( $binarystring, $half )
		{
			$length_half = strlen($binarystring) / 2;
			
			$selected = ( $half )
				? substr($binarystring, $length_half - 1, $length_half)
				: substr($binarystring, 0, $length_half);
			
			$original = ( $half )
				? substr($binarystring, 0, $length_half).str_repeat('X', $length_half)
				: str_repeat('X', $length_half).substr($binarystring, $length_half - 1, $length_half);
			
			return array(
				'original' => $original,
				'selected' => $selected,
			);
		}
		
		// TODO: comment
		public static function select_ordinal( $binarystring, $position )
		{
			$original = '';
			$selected = '';
			
			for( $i = 0; $i < strlen($binarystring); $i++ )
			{
				if( ($i % $position) == 0 )
				{
					$original .= 'X';
					$selected .= substr($binarystring, $i, 1);
					continue;
				}
				
				$original .= substr($binarystring, $i, 1);
			}
			
			return array(
				'original' => $original,
				'selected' => $selected,
			);
		}
		
		// TODO: comment
		public static function select_quarter( $binarystring, $position )
		{
			$original = '';
			$selected = '';
			
			$length_quarter = strlen($binarystring) / 4;
			
			for( $i = 0; $i < $length_quarter; $i++ )
			{
				if( $i == $position )
				{
					$original .= str_repeat('X', $length_quarter);
					$selected .= substr($binarystring, ($i * $length_quarter), $length_quarter);
					continue;
				}
				
				$original .= substr($binarystring, ($i * $length_quarter), $length_quarter);
			}
			
			return array(
				'original' => $original,
				'selected' => $selected,
			);
		}
		
		// TODO: comment
		public static function select_quarters( $binarystring, $positions )
		{
			$original = '';
			$selected = '';
			
			$length_quarter = strlen($binarystring) / 4;
			
			for( $i = 0; $i < $length_quarter; $i++ )
			{
				if( in_array($i, $positions) )
				{
					$original .= str_repeat('X', $length_quarter);
					$selected .= substr($binarystring, ($i * $length_quarter), $length_quarter);
					continue;
				}
				
				$original .= substr($binarystring, ($i * $length_quarter), $length_quarter);
			}
			
			return array(
				'original' => $original,
				'selected' => $selected,
			);
		}
		
	}
