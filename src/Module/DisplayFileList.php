<?php

/*
 * File to load excel file in browser using Excel Spread Sheet.
 */
namespace Uniword\Module;

class DisplayFileList
{
    public function displayFileList()
    {
        $currentData=file_get_contents("Files/fileList.json");
        $arrayData=json_decode($currentData, true);

        echo "<div class = 'Display_Table'>
    <h3>File List</h3>
    <table>
        <tr>
        
            <th>File Name</th>
            <th>Download</th>

        </tr>";
        foreach($arrayData as $key=>$val)
        {
            echo " <tr>

           
            <td>". $val['fileName']."</td>
            <td><a href='".$val['filePath']."' >Download</a><br/></td>

        </tr>";
        }
        echo "</table></div>";
    }
}