<a  href="#"
    onclick="showmodal();" 
    class="btn btn-white btn-default align-middle hidden-xs">
    
    Войти

</a>

<script>
    function showmodal() {
        document.getElementById("modal").style.display = "block";
    }

    function closemodal() {
        document.getElementById("modal").style.display = "none";
    }
</script>

<style>
    .modal-background {
        display: none;
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1000;
    }

    .modal-form {
        width: 300px;
        height: auto;
        background-color: white;
        padding: 20px;
        margin: 100px auto 0;

        border-radius: 10px;
        border: 1px solid black;
    }

    .modal-form input {
        height: 32px;
    }

    .modal-form table td,
    .modal-form table th {
        line-height: normal;
    }

</style>

<div class="modal-background" id="modal" onclick="closemodal();">
    <div class="modal-form" onclick="event.stopPropagation();">
        <div class="content">
            <form method="POST" action="/usercontr/userLog">
                <input type="hidden" name="action" value="checklogin" />
                <table>
                    <tr>
                        <th>
                            Пользователь
                        </th>
                        <td>
                            <input type="text" name="login">
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Пароль
                        </th>
                        <td>
                            <input type="password" name="password">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: right">
                            <input type="submit" value="Отправить" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>