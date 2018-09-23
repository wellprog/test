<div class="col-lg-3 col-sm-4">
    
    </div>
    <div class="col-lg-9 col-sm-8">
        <div class="white_bg border5 mb30 shadow p20 text text-blue">
        
       
            <h1> Пользователь <?= $MODEL ?>  залогинен </h1>
            <form method="POST" enctype="application/x-www-form-urlencoded" >
                <input type="submit" name="logout" value="Выйти" />
            </form>
            
            
        </div>
    </div>
    <div class="col-lg-9 col-sm-8">
        <div class="white_bg border5 mb30 shadow p20 text text-blue">
        
       
            <h1> Пользователь <?= $MODEL ?>  залогинен </h1>
            <form method="POST" enctype="application/x-www-form-urlencoded" >
                <input type="submit" name="logout" value="Выйти" />
            </form>
            
            
        </div>
    </div>

<div class="col-lg-3 col-sm-4">
    <form method="POST" enctype="application/x-www-form-urlencoded" >
        <input type="hidden" name="action" value="checklogin" />
       <p> Сменить пользователя </p>
        <table>
            <tr>
                <th>Логин</th>
                <td><input type="text" name="login"  /></td>
            </tr>
            <tr>
                <th>Пароль</th>
                <td><input type="text" name="password"  /></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" value="Войти" />
                </td>
            </tr>
        </table>
    </form>
</div>
    
