<?php
	class Selection
	{
		protected $_binarystring = null;
		
		protected $_callback_selection = null;
		protected $_callback_mutation = null;
		
		protected $_map_selection = array(
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
		
		public function __construct( $binarystring = '', $selection = null, $mutation = null )
		{
			$this->_callback_selection = $this->_map_selection[$selection];
			
			$this->_callback_mutation = $this->_map_mutation[$mutation];
			
			$this->_binarystring = ''; // TODO: call_user_func() from mapped callback definition
		}
		
		
		public function decode()
		{
		}
		
		public function encode()
		{
		}
		
		
		// TODO: mutation functions
		protected function mutate_shift_right( $spaces )
		{
			// TODO
		}
		
		// TODO: mutation functions
		protected function mutate_shift_left( $spaces )
		{
			// TODO
		}
		
		// TODO: comment
		protected function select_half( $half )
		{
			// TODO
		}
		
		
		// TODO: comment
		protected function select_ordinal( $position )
		{
			// TODO
		}
		
		// TODO: comment
		protected function select_quarter( $half )
		{
			// TODO
		}
		
		// TODO: comment
		protected function select_quarters( $half )
		{
			// TODO
		}
		
		
	}
