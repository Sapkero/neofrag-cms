<?php if (!defined('NEOFRAG_CMS')) exit;
/**************************************************************************
Copyright © 2015 Michaël BILCOT & Jérémy VALENTIN

This file is part of NeoFrag.

NeoFrag is free software: you can redistribute it and/or modify
it under the terms of the GNU Lesser General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

NeoFrag is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU Lesser General Public License for more details.

You should have received a copy of the GNU Lesser General Public License
along with NeoFrag. If not, see <http://www.gnu.org/licenses/>.
**************************************************************************/

class w_user_c_checker extends Controller_Module
{
	public function index_mini($settings = array())
	{
		return array(
			'align' => !empty($settings['align']) && in_array($settings['align'], array('navbar-left', 'navbar-right')) ? $settings['align'] : 'navbar-right'
		);
	}
}

/*
NeoFrag Alpha 0.1.4
./neofrag/widgets/user/controllers/checker.php
*/