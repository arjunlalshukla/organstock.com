<?php
function show_organ_table($organs){
    foreach ($organs as $organ){
        $organ_id = $organ['id'];
        $seller = $organ['seller_username'];
        $organ_type = $organ['organ_type'];
        $blood_type = $organ['blood_type'];
        $sex = $organ['sex'];
        $dob = $organ['owner_dob'];
        $d1 = new DateTime($dob);
        $d2 = new DateTime(date("Y-m-d"));
        $diff = $d2->diff($d1);
        $age = $diff->y;
        $weight = $organ['weight'];
        $price = $organ['price'];
        $description = $organ['description'];
        $image_html = $organ['image_path'] == "none" ? '' : "<a href=\"/php/organ.php?organ_id=$organ_id\"><div><img class=\"organ_listing\" src=\"/images/organs/$organ_id\" alt=\"organ pic\"></div></a>";
        echo
            "<tr>
				<td>$image_html</td>
				<td><a href=\"/php/organ.php?organ_id=$organ_id\"" . htmlspecialchars($organ_id) . "\"><div><table>
					<tr><td><table class=\"organ_listing_info\"><tr>
						<td class=\"organ_listing_info\">" . htmlspecialchars($organ_type) . "</td>
						<td class=\"organ_listing_info\">Blood Type: " . htmlspecialchars($blood_type) . "</td>
						<td class=\"organ_listing_info\">Sex: " . htmlspecialchars($sex) . "</td>
						<td class=\"organ_listing_info\">Age: " . htmlspecialchars($age) . "</td>
						<td class=\"organ_listing_info\">Weight: " . htmlspecialchars($weight) . "</td>
						<td class=\"organ_listing_info\">Price: $ " . htmlspecialchars($price) . "</td>
					</tr></table></td></tr>
					<tr><td class=\"organ_listing_info\">
                        " . htmlspecialchars($description) . "
					</td></tr>
				</table></div></a></tr>
			</tr>";
    }
}

function show_image($path){
    if (file_exists($path))
        echo $path == "none" ? '' : "<img class=\"profile\" src=\"$path\" alt=\"profile pic\"></a>";
}

function drop_down_from_file($file_path, $name, $messages, $presets){
    echo '<select name="' . $name . '">';
    $file = file_get_contents($file_path);
    $file = explode("\n", trim($file));
    foreach ($file as $line){
        $line = trim($line);
        $selected = isset($presets[$name]) && !isset($messages[$name]) && $presets[$name] == $line ? 'selected="selected"' : '';
        echo "<option value=\"$line\" $selected>$line</option>";
    }
    echo '</select>';
}

function check_boxes_from_file($file_path, $name, $presets, $num_per_line){
    $file = file_get_contents($file_path);
    $file = explode("\n", trim($file));
    $i = 0;
    foreach ($file as $line){
        $line = trim($line);
        $checked = isset($presets[$line]) ? 'checked' : '' ;
        echo "<input type=\"checkbox\" name=\"$line\" id=\"$line\" $checked><label for=\"$line\" class=\"organ\">$line</label>";
        $i = $i + 1;
        if ($i % $num_per_line == 0 && $line != end($file)) {
            echo "<br>";
        }
    }
}

function message($messages, $name){
    if (isset($messages[$name])){
        echo '<div class="message">' . $messages[$name] . "<button type='button' class='close'>X</button>" . "</div>";
        unset($_SESSION['messages'][$name]);
    }
}

function fill_preset($messages, $presets, $name){
    echo isset($presets[$name]) && !isset($messages[$name]) ? $presets[$name] : '';
}

