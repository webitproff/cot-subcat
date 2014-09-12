<?php
/*
 * [BEGIN_COT_EXT]
 * Hooks=page.list.query
 * Order=1
 * [END_COT_EXT]
 */

/**
 * Subcat Plugin for Cotonti Siena CMF
 *
 * @version 4.00
 * @author esclkm
 * @copyright (c) 2008-2011 esclkm
 */

defined('COT_CODE') or die('Wrong URL');

$subcat = cot_import('cs','G','BOL') ? 1 : 0;
$nosubcat = cot_import('ncs','G','BOL') ? 1 : 0;
$subcat && $list_url_path['sc'] = $subcat;
$nosubcat && $list_url_path['nsc'] = $nosubcat;

$scats = explode(',', $cfg['plugin']['subcat']['cats']);
array_walk($scats, 'trim');

$scatarray = array();
foreach ($scats as $scat)
{
	$scatarray = array_merge(cot_structure_children('page', $scat), $scatarray);
}

if (!$nosubcat && ($subcat || in_array($c, $scatarray)) && $c != 'all' && $c != 'unvalidated')
{
	
	$catlist2 = cot_structure_children('page', $c);
	$where['cat'] = "page_cat IN ('".implode("','", $catlist2)."')";
}
