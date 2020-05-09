<main>
    <h2>Change Password</h2>
    <form action="changePassword" method="post">
        <table>
            <tr>
                <td>Old Password</td>
                <td>:</td>
                <td>
                    <input type="password" name='oldPass' required>
                </td>
            </tr>
            <tr>
                <td>New Password</td>
                <td>:</td>
                <td>
                    <input type="password" name="newPass" required>
                </td>
            </tr>
            <tr>
                <td>Confirm New Password</td>
                <td>:</td>
                <td>
                    <input type="password" name="confirmPass" required>
                </td>
            </tr>
        </table>
        <p class='msg' style='display: none'></p>
        <button type="submit">Change</button>
    </form>
</main>
<div class="modal">
    <div>
        <h2></h2>
        <span></span><br>
        <button>OK</button>
    </div>
</div>