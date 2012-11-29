<?php
//for 1-10 dropdown
function dropdown()
{
    global $x;
    echo "<option>--</option>";   
    for($x=1;$x<11;$x++) {
	echo "<option value='$x'>$x</option>";
    }
}


function techreq_dt($x)
{
        for($x=2;$x<7;$x++) {
              echo "<tr class='aligncenter'><td><select name='dt_qty$x' class='aligncenter'>";
              dropdown(11);
              echo "</select></td>
              <td><input type='text' name='dt_operating_system$x' class='techreqtextlg'/></td>
              <td><input type='text' name='dt_memory$x' class='techreqtextsm'/></td>
              <td><input type='text' name='dt_disk$x' class='techreqtextsm'/></td>
              <td><select name=dt_vm$x><option>--</option><option value='Yes'>Yes</option><option value='No'>No</option></select></td>
              <td><input type='text' name='dt_software$x' class='techreqtextlg'/></td>
              <td><textarea name='dt_notes$x' cols='20' rows='1'></textarea></td></tr>";
        }
}

function techreq_server()
{
       for($x=2;$x<7;$x++) {
              echo "<tr class='aligncenter'><td><select name='server_qty$x' class='aligncenter'>";
              dropdown(11);
              echo "</select></td>
              <td><input type='text' name='server_operating_system$x' class='techreqtextlg'/></td>
              <td><input type='text' name='server_memory$x' class='techreqtextsm'/></td><td><input type='text' name='server_disk$x' class='techreqtextsm'/></td>
              <td><select name=server_vm$x><option>--</option><option value='Yes'>Yes</option><option value='No'>No</option></select></td>
              <td><input type='text' name='server_software$x' class='techreqtextlg'/></td><td><textarea name='server_notes$x' cols='20' rows='1'></textarea></td></tr>";
        }
}


function stakeholders()
{
        for($x=1;$x<7;$x++) {
              echo " <tr><td><input type='text' name='stakeholder$x' /></td><td><input type='text' class='textwidth' name='role$x' /></td></tr>";
        }
}

?>
