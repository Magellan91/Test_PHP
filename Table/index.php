<?php
$setting = [array(
    'text' => 'Text 1',
    'cells' => '1,2,3',
    'align' => 'center',
    'valign' => 'center',
    'color' => 'red',
    'bgcolor' => '#0000FF',
), array(
    'text' => 'Text 2',
    'cells' => '4,7',
    'align' => 'center',
    'valign' => 'top',
    'color' => '00FF00',
    'bgcolor' => '#FFFF0F',
), array(
    'text' => 'Text 3',
    'cells' => '5,6',
    'align' => 'center',
    'valign' => 'center',
    'color' => 'F0FF00',
    'bgcolor' => '#FF0F0F',
), array(
    'text' => 'Text 4',
    'cells' => '9',
    'align' => 'center',
    'valign' => 'center',
    'color' => 'F0FFF0',
    'bgcolor' => '#0F0F0F',
)];

function getTable($arr)
{
    $cells_box = [];
    $error = [];
    for ($i = 0; count($arr) > $i; ++$i) {
        $cells_box[$i] = explode(',', $arr[$i]['cells']);
    }
    foreach ($cells_box as $val) {
        $error = array_merge($error, $val);
    }
    $first_count = count($error);
    $second_count = count(array_unique($error));

    if ($first_count != $second_count) {
        die('В параметра есть одинаковые элементы');
    }
    $box = 0;
    echo '<pre><table border="1" height="500"  width="500">';
    for ($o = 0; $o < 3; $o++) {
        echo '<tr>';
        $count = 3;
        for ($i = 0; $i < $count; ++$i) {
            $box++;
            for ($j = 0; count($arr) > $j; ++$j) {
                $cells_box = explode(',', $arr[$j]['cells']);
                if (in_array($box, $cells_box)) {
                    if (in_array($box + 1, $cells_box)) {

                        if (in_array($box + 2, $cells_box)) {
                            echo '<td colspan="3" align="' . $arr[$j]['align'] . '" valign="' . $arr[$j]['valign'] . '"style="color:' . $arr[$j]['color'] . '; background-color:' . $arr[$j]['bgcolor'] . '">' . $arr[$j]['text'] . '</td>';
                            $box = $box + 2;
                            $i = $i + 2;
                        } else {
                            if (in_array($box + 4, $cells_box)) {
                                echo '<td colspan="2" rowspan="2" align="' . $arr[$j]['align'] . '" valign="' . $arr[$j]['valign'] . '"style="color:' . $arr[$j]['color'] . '; background-color:' . $arr[$j]['bgcolor'] . '">' . $arr[$j]['text'] . '</td>';
                                $box++;
                                $i++;
                            } elseif ((!in_array($box - 3, $cells_box))) {
                                echo '<td colspan="2" align="' . $arr[$j]['align'] . '" valign="' . $arr[$j]['valign'] . '"style="color:' . $arr[$j]['color'] . '; background-color:' . $arr[$j]['bgcolor'] . '">' . $arr[$j]['text'] . '</td>';
                                $box++;
                                $i++;
                            }
                        }
                    } else {
                        if (in_array($box + 3, $cells_box)) {
                            if (in_array($box + 6, $cells_box)) {
                                echo '<td rowspan="3" align="' . $arr[$j]['align'] . '" valign="' . $arr[$j]['valign'] . '"style="color:' . $arr[$j]['color'] . '; background-color:' . $arr[$j]['bgcolor'] . '">' . $arr[$j]['text'] . '</td>';
                            } elseif (!in_array($box - 3, $cells_box)) {
                                echo '<td rowspan="2" align="' . $arr[$j]['align'] . '" valign="' . $arr[$j]['valign'] . '"style="color:' . $arr[$j]['color'] . '; background-color:' . $arr[$j]['bgcolor'] . '">' . $arr[$j]['text'] . '</td>';
                            }
                        } else {
                            if ((!in_array($box - 2, $cells_box))) {
                                if (!in_array($box - 3, $cells_box)) {
                                    echo '<td align="' . $arr[$j]['align'] . '" valign="' . $arr[$j]['valign'] . '"style="color:' . $arr[$j]['color'] . '; background-color:' . $arr[$j]['bgcolor'] . '">' . $arr[$j]['text'] . '</td>';
                                }
                            }
                        }
                    }
                    continue 2;

                }
            }

            echo "<td align='center'>   $box   </td>";
        }

    }


    echo '</tr>';

    echo '</table></pre>';


}


getTable($setting);