<!-- BEGIN KUNDENLOGIN -->
<div id="aeussere_loginbox_kunde">
    <div id="loginbox_innen_left_kunde">
        <div id="login_sign">
        </div>
        <p>
            Verwenden Sie ein gültiges Passwort um Zugang zu erhalten.
        </p>
    </div>
    <div id="loginbox_innen_right_kunde">
        <h2>Login</h2>
        <div id="little_loginbox_kunde">
            <form {loginform_attributes}>
                 <table>
                 	<tr>
                 		<td colspan="2">{loginform_passwort_label}{loginform_hidden}</td>
                 	</tr>
                 	<tr>
                 		<td>{loginform_passwort_html}</td>
                 		<td>{loginform_submit_html}</td>
                 	</tr>
                 </table>                    
                <div class="error">
                    <!-- BEGIN loginform_error_loop -->{loginform_error}
                    <br/>
                    <!-- END loginform_error_loop -->
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END KUNDENLOGIN -->
