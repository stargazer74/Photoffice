<!-- BEGIN LOGIN -->
<div id="aeussere_loginbox">
    <div id="loginbox_innen_left">
        <div id="login_sign">
        </div>
        <p>
            Willkommen im Adminbereich von photoffice.
        </p>
        <p>
            Verwenden Sie einen gültigen Benutzernamen mit Passwort um Zugang zu erhalten.
        </p>
    </div>
    <div id="loginbox_innen_right">
        <h2>Login</h2>
        <div id="little_loginbox">
            <form {loginform_attributes}>
                <div class="formlabel">
                	<p>
                    {loginform_benutzername_label}
                	</p>
                </div>
                <div>
                	<p>
                    {loginform_benutzername_html}
                    </p>
                </div>
                <div class="formlabel">
                	<p>
                    {loginform_passwort_label}{loginform_hidden}
                    </p>
                </div>
                <div>
                	<p>
                    {loginform_passwort_html}
                    </p>
                </div>
                <div class="formlabel">
                	<p>
                    {loginform_submit_html}
                    </p>
                </div>
                <div class="error">
                    <!-- BEGIN loginform_error_loop -->{loginform_error}
                    <br/>
                    <!-- END loginform_error_loop -->
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END LOGIN -->
