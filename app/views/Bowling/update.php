<?= $data['title']; ?>
<? if(isset($message)){
    echo($message);
}
?>
<form action="<?= URLROOT; ?>/Bowling/update" method="POST">
    <table>
        <tbody>
            <tr>
                <td>
                    <input type="text" name="Score_Name" id="Score_Name" value="<?= $data['row']->Score_Name ;?>">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="number" name="Score" id="Score" value="<?= $data['row']->Score ;?>">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="DATE" name="DATE" id="DATE" value="<?= $data['row']->DATE ;?>">
                </td>
            </tr>
   <!--         <tr>
                <td>
                    <input type="number" name="Alley" id="Alley" value="<? /*$data['row']->Alley ;*/?>">
                </td>
            </tr> -->
            <tr>
                <td>
                    <input type="hidden" name="id" value="<?= $data['row']->ID ;?>">
                </td>
                <td>
                    <input type="hidden" name="UserID" value="<?= $data['row']->UserID ;?>">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="send">
                </td>
            </tr>
        </tbody>
    </table>


</form>

