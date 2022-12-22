<?= $data['title']; ?>
<?= var_dump($_POST); ?>
<body>
    
<form action="<?= URLROOT; ?>/countries/create" method="POST">
    <table>
        <tbody>
            <tr>
                <td>
                    <label for="name">Land naam</label>
                    <input type="text" name="name" id="name" value="">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="capitalCityy">Hoodstad</label>
                    <input type="text" name="capitalCity" id="capitalCity" value="">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="continent">continent</label>
                    <input type="text" name="continent" id="continent" value="">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="population">populatie</label>
                    <input type="number" name="population" id="population" value="">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="hidden" name="id" value="">
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

<h3>oi</h3>
    
</body>
