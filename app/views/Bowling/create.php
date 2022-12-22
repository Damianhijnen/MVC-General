<?= $data['title']; ?>
<?= var_dump($_POST); ?>
<body>
    
    <form action="<?= URLROOT; ?>/Bowling/create" method="POST">
        <table>
            <tbody>
                <tr>
                    <td>
                        <label for="Score_Name">Score naam</label>
                        <input type="text" name="Score_Name" id="Score_Name" value="">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="Score">Score</label>
                        <input type="number" name="Score" id="Score" value="">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="DATE">Date</label>
                        <input type="DATE" name="DATE" id="DATE" value="">
                    </td>
                </tr>
                <tr>
                    <td>
                    <label for="UserID">UserID</label>
                        <input type="number" name="UserID" id="UserID" value="">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="id" value="NULL">
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

</body>