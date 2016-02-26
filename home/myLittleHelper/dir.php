<?php
/**
 * User: planet17
 * Date: 25.02.16
 * Time: 22:43
 */

/**
 *
 * @param string $cd using dir __DIR__ - it is path to current dir from where you call that function
 * @param int $i
 * @param array $ds level by level names of directory
 *
 * @return string full path to directory
 */
function helpers_pl17_dir_get($cd, $i, array $ds = []) { while ($i-- > 0) { $cd = helpers_pl17_dir_down($cd); } unset($i); while (count($ds)) { $d = array_shift($ds); $cd = helpers_pl17_dir_to($cd, $d); } unset($d, $ds); return $cd; }
function helpers_pl17_dir_down($d) { return dirname($d); } function helpers_pl17_dir_to($cd, $d) { return $cd . DIRECTORY_SEPARATOR . $d; }