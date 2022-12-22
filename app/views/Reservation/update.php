
<?  
if(isset($message)){
    echo($message);
}
?>


<h1>Wijzig reservering</h1>
<form action="<?= URLROOT; ?>/Reservation/update" method="POST">
    <table>
        <tbody>
            <tr>
                <td>
                    <label for="nummer">Baan Nummer</label>
                    <input type="number" name="nummer" min = '1' max="8" id="nummer" value="<?= $data['row']->nummer;?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="nummer">Aantal Volwassen</label>
                    <input type="number" name="AantalVolwassen" min = '1' max="8" id="AantalVolwassen" value="<?= $data['row']->AantalVolwassen ;?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="nummer">Aantal Kinderen</label>
                    <input type="number" name="AantalKinderen" Min ='0' max="4" id="AantalKinderen" value="<?= $data['row']->AantalKinderen ;?>">
                </td>
            </tr>
            <tr>
                <td>
                
                    <? $hek=$data['row']->Heefthek;
                    if($hek== true){
                        echo("Heeft een hekje");
                    } else{
                        echo("Heeft geen hekje");
                    }
                    
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                <label >Datum</label>
                    <?= $data['row']->Datum?>
                </td>
            </tr> 
            <tr>
                <td>
                  
                  <h5>Tijdstip <?= $data['row']->BeginTijd?> - <?= $data['row']->EindTijd?> </h5>
                </td>
            </tr> 
            <tr>
                <td>
                    <input type="hidden" name="ID" value="<?= $data['row']->ID ;?>">
                </td>
                <td>
                    <input type="hidden" name="persoonID" value="<?= $data['row']->persoonID ;?>">
                </td>
                <td>
                    <input type="hidden" name="TariefID" value="<?= $data['row']->TariefID ;?>">
                </td>
                <td>
                    <input type="hidden" name="Reserveringsnummer" value="<?= $data['row']->Reserveringsnummer ;?>">
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

