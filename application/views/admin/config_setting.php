        <div id="page-wrapper">
           
            <div class="row panel-blue">
        <div class="col-md-8">
        <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-globe"></i> Site Settings</h3>
        </div>
        <div class="panel-body">
            <div id="settings-alerts">
                <div class="alert alert-success">All settings have been saved</div>
            </div>
            <form class="form-horizontal" role="form" name="settings" action="<?= base_url()?>public/config/settings" method="post" novalidate="novalidate">
                                     
                        <div class="form-group">
                            <label for="input_site_title" class="col-xs-4 col-sm-3 col-lg-2 control-label">Site Title</label>
                            <div class="col-xs-8 col-sm-9 col-lg-10">
                                                                    <input type="text" id="input_site_title" class="form-control" name="userfrosting[site_title]" value="MedConnex">
                                                                <p class="help-block">The title of the site.  By default, displayed in the title tag, as well as the upper left corner of every user page.</p>
                            </div>
                        </div>
                     
                        <div class="form-group">
                            <label for="input_site_location" class="col-xs-4 col-sm-3 col-lg-2 control-label">Site Location</label>
                            <div class="col-xs-8 col-sm-9 col-lg-10">
                                                                    <input type="text" id="input_site_location" class="form-control" name="userfrosting[site_location]" value="The State of Indiana">
                                                                <p class="help-block">The nation or state in which legal jurisdiction for this site falls.</p>
                            </div>
                        </div>
                     
                        <div class="form-group">
                            <label for="input_author" class="col-xs-4 col-sm-3 col-lg-2 control-label">Site Author</label>
                            <div class="col-xs-8 col-sm-9 col-lg-10">
                                                                    <input type="text" id="input_author" class="form-control" name="userfrosting[author]" value="Damilare Binutu">
                                                                <p class="help-block">The author of the site.  Will be used in the site's author meta tag.</p>
                            </div>
                        </div>
                     
                        <div class="form-group">
                            <label for="input_admin_email" class="col-xs-4 col-sm-3 col-lg-2 control-label">Account Management Email</label>
                            <div class="col-xs-8 col-sm-9 col-lg-10">
                                                                    <input type="text" id="input_admin_email" class="form-control" name="userfrosting[admin_email]" value="admin@medconnex.com">
                                                                <p class="help-block">The administrative email for the site.  Automated emails, such as verification emails and password reset links, will come from this address.</p>
                            </div>
                        </div>
                     
                        <div class="form-group">
                            <label for="input_default_locale" class="col-xs-4 col-sm-3 col-lg-2 control-label">Locale for New Users</label>
                            <div class="col-xs-8 col-sm-9 col-lg-10">
                                                                    <div class="select2-container form-control select2" id="s2id_input_default_locale"><a href="javascript:void(0)" class="select2-choice" tabindex="-1">   <span class="select2-chosen" id="select2-chosen-1">en_US</span><abbr class="select2-search-choice-close"></abbr>   <span class="select2-arrow" role="presentation"><b role="presentation"></b></span></a><label for="s2id_autogen1" class="select2-offscreen">Locale for New Users</label><input class="select2-focusser select2-offscreen" type="text" aria-haspopup="true" role="button" aria-labelledby="select2-chosen-1" id="s2id_autogen1"><div class="select2-drop select2-display-none select2-with-searchbox">   <div class="select2-search">       <label for="s2id_autogen1_search" class="select2-offscreen">Locale for New Users</label>       <input type="text" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" class="select2-input" role="combobox" aria-expanded="true" aria-autocomplete="list" aria-owns="select2-results-1" id="s2id_autogen1_search" placeholder="">   </div>   <ul class="select2-results" role="listbox" id="select2-results-1">   </ul></div></div><select id="input_default_locale" class="form-control select2 select2-offscreen" name="userfrosting[default_locale]" tabindex="-1" title="Locale for New Users">
                                                                                <option value="de_DE">de_DE</option>
                                                                                <option value="en_US" selected="">en_US</option>
                                                                                <option value="es_ES">es_ES</option>
                                                                                <option value="fr_FR">fr_FR</option>
                                                                                <option value="it_IT">it_IT</option>
                                                                                <option value="nl_NL">nl_NL</option>
                                                                                <option value="pt_BR">pt_BR</option>
                                                                                <option value="ro_RO">ro_RO</option>
                                                                                <option value="th_TH">th_TH</option>
                                                                                <option value="tr_TR">tr_TR</option>
                                                                            </select>
                                                                <p class="help-block">The default language for newly registered users.</p>
                            </div>
                        </div>
                     
                        <div class="form-group">
                            <label for="input_guest_theme" class="col-xs-4 col-sm-3 col-lg-2 control-label">Guest Theme</label>
                            <div class="col-xs-8 col-sm-9 col-lg-10">
                                                                    <div class="select2-container form-control select2" id="s2id_input_guest_theme"><a href="javascript:void(0)" class="select2-choice" tabindex="-1">   <span class="select2-chosen" id="select2-chosen-2">default</span><abbr class="select2-search-choice-close"></abbr>   <span class="select2-arrow" role="presentation"><b role="presentation"></b></span></a><label for="s2id_autogen2" class="select2-offscreen">Guest Theme</label><input class="select2-focusser select2-offscreen" type="text" aria-haspopup="true" role="button" aria-labelledby="select2-chosen-2" id="s2id_autogen2"><div class="select2-drop select2-display-none select2-with-searchbox">   <div class="select2-search">       <label for="s2id_autogen2_search" class="select2-offscreen">Guest Theme</label>       <input type="text" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" class="select2-input" role="combobox" aria-expanded="true" aria-autocomplete="list" aria-owns="select2-results-2" id="s2id_autogen2_search" placeholder="">   </div>   <ul class="select2-results" role="listbox" id="select2-results-2">   </ul></div></div><select id="input_guest_theme" class="form-control select2 select2-offscreen" name="userfrosting[guest_theme]" tabindex="-1" title="Guest Theme">
                                                                                <option value="default" selected="">default</option>
                                                                                <option value="nyx">nyx</option>
                                                                                <option value="root">root</option>
                                                                            </select>
                                                                <p class="help-block">The template theme to use for unauthenticated (guest) users.</p>
                            </div>
                        </div>
                     
                        <div class="form-group">
                            <label for="input_can_register" class="col-xs-4 col-sm-3 col-lg-2 control-label">Public Registration</label>
                            <div class="col-xs-8 col-sm-9 col-lg-10">
                                                                    <div class="has-switch switch-animate switch-on" tabindex="0"><div><span class="switch-left">ON</span><label for="input_can_register">&nbsp;</label><span class="switch-right">OFF</span><input type="checkbox" id="input_can_register" class="form-control bootstrapswitch" name="userfrosting[can_register]" value="1" data-off-text="Off" data-on-text="On" checked=""></div></div>
                                                                <p class="help-block">Specify whether public registration of new accounts is enabled.  Enable if you have a service that users can sign up for, disable if you only want accounts to be created by you or an admin.</p>
                            </div>
                        </div>
                     
                        <div class="form-group">
                            <label for="input_enable_captcha" class="col-xs-4 col-sm-3 col-lg-2 control-label">Registration Captcha</label>
                            <div class="col-xs-8 col-sm-9 col-lg-10">
                                                                    <div class="has-switch switch-animate switch-on" tabindex="0"><div><span class="switch-left">ON</span><label for="input_enable_captcha">&nbsp;</label><span class="switch-right">OFF</span><input type="checkbox" id="input_enable_captcha" class="form-control bootstrapswitch" name="userfrosting[enable_captcha]" value="1" data-off-text="Off" data-on-text="On" checked=""></div></div>
                                                                <p class="help-block">Specify whether new users must complete a captcha code when registering for an account.</p>
                            </div>
                        </div>
                     
                        <div class="form-group">
                            <label for="input_show_terms_on_register" class="col-xs-4 col-sm-3 col-lg-2 control-label">Show TOS</label>
                            <div class="col-xs-8 col-sm-9 col-lg-10">
                                                                    <div class="has-switch switch-animate switch-on" tabindex="0"><div><span class="switch-left">ON</span><label for="input_show_terms_on_register">&nbsp;</label><span class="switch-right">OFF</span><input type="checkbox" id="input_show_terms_on_register" class="form-control bootstrapswitch" name="userfrosting[show_terms_on_register]" value="1" data-off-text="Off" data-on-text="On" checked=""></div></div>
                                                                <p class="help-block">Specify whether or not to show terms and conditions when registering.</p>
                            </div>
                        </div>
                     
                        <div class="form-group">
                            <label for="input_require_activation" class="col-xs-4 col-sm-3 col-lg-2 control-label">Require Account Activation</label>
                            <div class="col-xs-8 col-sm-9 col-lg-10">
                                                                    <div class="has-switch switch-animate switch-on" tabindex="0"><div><span class="switch-left">ON</span><label for="input_require_activation">&nbsp;</label><span class="switch-right">OFF</span><input type="checkbox" id="input_require_activation" class="form-control bootstrapswitch" name="userfrosting[require_activation]" value="1" data-off-text="Off" data-on-text="On" checked=""></div></div>
                                                                <p class="help-block">Specify whether email verification is required for newly registered accounts.  Accounts created by another user never need to be verified.</p>
                            </div>
                        </div>
                     
                        <div class="form-group">
                            <label for="input_email_login" class="col-xs-4 col-sm-3 col-lg-2 control-label">Email Login</label>
                            <div class="col-xs-8 col-sm-9 col-lg-10">
                                                                    <div class="has-switch switch-animate switch-on" tabindex="0"><div><span class="switch-left">ON</span><label for="input_email_login">&nbsp;</label><span class="switch-right">OFF</span><input type="checkbox" id="input_email_login" class="form-control bootstrapswitch" name="userfrosting[email_login]" value="1" data-off-text="Off" data-on-text="On" checked=""></div></div>
                                                                <p class="help-block">Specify whether users can login via email address or username instead of just username.</p>
                            </div>
                        </div>
                     
                        <div class="form-group">
                            <label for="input_resend_activation_threshold" class="col-xs-4 col-sm-3 col-lg-2 control-label">Resend Activation Email Cooloff (s)</label>
                            <div class="col-xs-8 col-sm-9 col-lg-10">
                                                                    <input type="text" id="input_resend_activation_threshold" class="form-control" name="userfrosting[resend_activation_threshold]" value="0">
                                                                <p class="help-block">The time, in seconds, that a user must wait before requesting that the account verification email be resent.</p>
                            </div>
                        </div>
                     
                        <div class="form-group">
                            <label for="input_reset_password_timeout" class="col-xs-4 col-sm-3 col-lg-2 control-label">Password Recovery Timeout (s)</label>
                            <div class="col-xs-8 col-sm-9 col-lg-10">
                                                                    <input type="text" id="input_reset_password_timeout" class="form-control" name="userfrosting[reset_password_timeout]" value="10800">
                                                                <p class="help-block">The time, in seconds, before a user's password reset token expires.</p>
                            </div>
                        </div>
                     
                        <div class="form-group">
                            <label for="input_create_password_expiration" class="col-xs-4 col-sm-3 col-lg-2 control-label">Create Password for New Users Timeout (s)</label>
                            <div class="col-xs-8 col-sm-9 col-lg-10">
                                                                    <input type="text" id="input_create_password_expiration" class="form-control" name="userfrosting[create_password_expiration]" value="86400">
                                                                <p class="help-block">The time, in seconds, before a new user's password creation token expires.</p>
                            </div>
                        </div>
                     
                        <div class="form-group">
                            <label for="input_minify_css" class="col-xs-4 col-sm-3 col-lg-2 control-label">Minify CSS</label>
                            <div class="col-xs-8 col-sm-9 col-lg-10">
                                                                    <div class="has-switch switch-animate switch-off" tabindex="0"><div><span class="switch-left">ON</span><label for="input_minify_css">&nbsp;</label><span class="switch-right">OFF</span><input type="checkbox" id="input_minify_css" class="form-control bootstrapswitch" name="userfrosting[minify_css]" value="0" data-off-text="Off" data-on-text="On"></div></div>
                                                                <p class="help-block">Specify whether to use concatenated, minified CSS (production) or raw CSS includes (dev).</p>
                            </div>
                        </div>
                     
                        <div class="form-group">
                            <label for="input_minify_js" class="col-xs-4 col-sm-3 col-lg-2 control-label">Minify JS</label>
                            <div class="col-xs-8 col-sm-9 col-lg-10">
                                                                    <div class="has-switch switch-animate switch-off" tabindex="0"><div><span class="switch-left">ON</span><label for="input_minify_js">&nbsp;</label><span class="switch-right">OFF</span><input type="checkbox" id="input_minify_js" class="form-control bootstrapswitch" name="userfrosting[minify_js]" value="0" data-off-text="Off" data-on-text="On"></div></div>
                                                                <p class="help-block">Specify whether to use concatenated, minified JS (production) or raw JS includes (dev).</p>
                            </div>
                        </div>
                                                </form>
        </div>
        </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-server"></i> System Information</h3>
                </div>
                <div class="panel-body">
                                            <p class="h6">UserFrosting Version</p>
                            <pre><code>0.3.1.23</code></pre>
                                            <p class="h6">Web Server</p>
                            <pre><code>Apache</code></pre>
                                            <p class="h6">PHP Version</p>
                            <pre><code>5.6.32</code></pre>
                                            <p class="h6">Database Version</p>
                            <pre><code>mysql 5.6.37</code></pre>
                                            <p class="h6">Database Name</p>
                            <pre><code>medconne_med</code></pre>
                                            <p class="h6">Table Prefix</p>
                            <pre><code>uf_</code></pre>
                                            <p class="h6">Application Root</p>
                            <pre><code>/home/medconnex/public_html/med/userfrosting</code></pre>
                                            <p class="h6">Document Root</p>
                            <pre><code>http://medconnex.net/med/public</code></pre>
                                    </div>
                <div class="panel-footer">
                    <a class="btn btn-link" href="http://medconnex.net/med/public/phpinfo">View phpinfo</a>
                    <a class="btn btn-link" href="http://medconnex.net/med/public/sliminfo">View Slim Info</a>
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-wrench"></i> Admin Tools</h3>
                </div>
                <div class="panel-body">
                    <p>
                        Rebuild minified CSS and JS: <a class="btn btn-primary" href="http://medconnex.net/med/public/config/build">Rebuild</a>
                    </p>
                    <p class="help-block">This may take some time, please be patient and wait for the page to refresh.</p>
                </div>
            </div>
        </div>
    </div>
            <!-- /.row -->

            <!-- /.row -->

            <!-- /.row -->

            <!-- /.row -->
        </div>