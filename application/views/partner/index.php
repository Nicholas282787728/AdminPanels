<style type="text/css">
    .blue{
        background-color: #50b0d2;
        color: #fff;
    }
    .dashboard-panel .nav-tabs > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover {
        background-color: #56bddc !important;
    }
    .dashboard-panel .nav-tabs > li > a {
        background-color: #33a8cb ;
        color: #fff; 
        margin-right: 0px;
    }
    .chatList{
        /*  height: 350px;*/
        height: 240px;
        overflow-y: auto;
    }

    /*  #user-type-chart svg{
            width:100%;
            min-width: 807px; 
        }*/
        .fc-toolbar .fc-right {
    float: right;
    display: none;
}
</style>
<div id="page-wrapper">
          <?php $this->load->view('partner/new-sidebar'); ?>
     <div class="row">
        <div class="col-lg-12">  <!-- <h1 class="page-header">Categories</h1> -->
        <?php 
        @$success_msg = $this->session->flashdata('success_msg');
        if(!empty($success_msg)) { ?>
               <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Success!</strong> <?php echo $this->session->flashdata('success_msg'); ?>.
              </div>
        <?php }elseif($this->session->flashdata('error_msg')){ ?>
            <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Danger!</strong> <?php echo $this->session->flashdata('error_msg'); ?>.
          </div>
        <?php }
    ?>

    <div class="row">
        <div class="col-lg-12 medconnex1">
            <div class="panel panel-default medconnex-panel"> <!-- class="panel panel-default medconnex-panel" -->
                <div class="panel-heading adi-head-blue2 medconnex-panelheading" style="text-align: left; padding: 0 4px; padding-bottom: 0px !important;"> <!-- class="panel-heading adi-head-blue2 medconnex-panelheading" -->
                    <h4>Affiliate Partner</h4><br>
                    <div class="row" style="text-align: center;">
                        <div class="col-sm-4 option-content-partner option-active" id="Market">Market</div>
                        <div class="col-sm-4 option-content-partner option-inactive" id="Requirements">Requirements</div>
                        <div class="col-sm-4 option-content-partner option-inactive" id="Application">Application</div>
                    </div>
                </div>
                <div class="panel-body medconnex-panelbody" style="padding-top: 0px;"> <!-- class="panel-body medconnex-panelbody" -->
                    <div class="content-partner active" id="contentPartnerMarket">
                        <div class="row">
                            <div class="col-sm-3 opcion-content-Market sub-option-active" id="Map">Map</div>
                            <div class="col-sm-3 opcion-content-Market sub-option-inactive" id="Description">Description</div>
                            <div class="col-sm-3 opcion-content-Market sub-option-inactive" id="Enrollment">Enrollment</div>
                            <div class="col-sm-3 opcion-content-Market sub-option-inactive" id="Go">Go to Market</div>
                        </div>
                        <div id="contentMarketMap" class="content-Market active">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h1>The States Where It's Legal To Smoke Marijuana</h1>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div id="imageColorMap1">
                                        <h4 class="cls12"><img src="<?php echo base_url(); ?>public/img/affiliate-partner-panel-design-list-icon1_03.png" alt="sideicon1"  width="28" height="28"><strong> Medical Use Only</strong></h4>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div id="imageColorMap1">
                                        <h4 class="cls12"><img src="<?php echo base_url(); ?>public/img/affiliate-partner-panel-design-listitem2_10.png" alt="sideicon2" width="28" height="28" ><strong> Legalized for Recreational Use</strong></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <img src="<?php echo base_url(); ?>public/img/affiliate-partner-panel-design-map_11.png" alt="map">
                                </div>
                            </div>
                        </div>
                        <div id="contentMarketDescription" class="content-Market inactive">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3 style="color:#e03d80"> <strong> Medical Use </strong></h3>
                                    <ol>
                                        <li>Arizona</li>
                                        <li>California</li>
                                        <li>Connecticut</li>
                                        <li>Delaware</li>
                                        <li>Hawaii</li>
                                        <li>lllinois</li>
                                        <li>Maine</li>
                                        <li>Maryland</li>
                                        <li>Massachusetts</li>
                                        <li>Michigan</li>
                                        <li>Minnesota</li>
                                        <li>Montana</li>
                                        <li>Nevada</li>
                                        <li>New Hampshire</li>
                                        <li>New Jersey</li>
                                        <li>New Mexico </li>
                                        <li>New York </li>
                                        <li>Pennsylvania</li>
                                        <li>Rhode Islands</li>
                                        <li>Vermont</li>
                                        <li>Arkansas</li>
                                        <li>Florida</li>
                                        <li>Montana</li>
                                        <li>North Dakota</li>
                                    </ol>
                                </div>
                                <div class="col-sm-6">
                                    <h3 style="color:#26b5b0"><strong> Recreational Use </strong></h3>
                                    <ol>
                                        <li>Navada</li>
                                        <li>Alaska</li>
                                        <li>Colorado</li>
                                        <li>Oregon</li>
                                        <li>Washington</li>
                                        <li>California</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <div id="contentMarketEnrollment" class="content-Market inactive">
                            <div class="row">
                                <div class="col-sm-12">
                                    <p>
                                        Med Connex is seeking affiliate partners, who understand our vision and expansion efforts. Our detailed Affiliate Partnership Program has been designed to provide ease in applying, transparency, and ability for exponential growth in selected markets.<br><br>

                                        The following steps are required when applying for an Affiliate Partnership License with Med Connex Mobile App:
                                    </p>
                                    <ol>
                                        <li>Online application</li>
                                        <li>Our due diligence</li>
                                        <li>Phone interview</li>
                                        <li>On-Site interview</li>
                                        <li>Product business plan</li>
                                        <li>Agreement & signing</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <div id="contentMarketGo" class="content-Market inactive">
                            <div class="row">
                                <div class="col-sm-12">
                                    <p>
                                        Once you have been approved for a distribution license, the following shall take place to ensure not only a dominant presence within your territory but also a successful launch in your region.
                                    </p>
                                    <ol>
                                        <li>Forward Starter Kit
                                            <p>(custom designs, promotional materials, training sessions, and more)</p>
                                        </li>
                                        <li>On-line Training Schedule</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-partner inactive" id="contentPartnerRequirements">
                        <div class="row">
                            <div class="col-sm-4 opcion-content-Requirements sub-option-active" id="Pre-Qualifications">Pre-Qualifications</div>
                            <div class="col-sm-4 opcion-content-Requirements sub-option-inactive" id="Requirements">Requeriments</div>
                            <div class="col-sm-4 opcion-content-Requirements sub-option-inactive" id="Licencia">Licensing Requeriments</div>
                        </div>
                        <div id="contentRequirementsPre-Qualifications" class="content-Requirements active">
                            <h1>Pre-Qualifications</h1>
                            <p>
                                Have "Good" credit<br><br>

                                Service in any branch of the U.S. military is +<br><br>

                                Not have filed for bankruptcy within the last (7) years<br><br>

                                Understand the need to be involved in the day operation of a small business<br><br>

                                Must have at least (3) years' experience in running an established retail, business operations or (7) years' of management experience<br><br>

                                Have no prior record of felony convictions or other criminal record that could impact your ability to operate a license
                            </p>
                        </div>
                        <div id="contentRequirementsRequirements" class="content-Requirements inactive">
                            <h1>Requirements</h1>
                            <p>
                                Appoint (1) assignee for all meetings, conference calls, trainings and daily campaign management tasks.<br><br>

                                Attend company conference calls, pre-scheduled meetings/gatherings at least 1 per month to ensure strong communication and assistance where needed.<br><br>

                                Affiliate must visit other local providers registered with our platform and drop off promotional and marketing materials and provide minor assistance where needed.<br><br>

                                Meet with local providers (4) per month for quality
                                control purposes and conduct a quick 15 minute meeting to address any concerns from an operating standpoint.<br><br>

                                Organize a mixer (social gathering) with local providers and interested afiliate partners at least once per quarter to maintain a strong and informative community.
                            </p>
                        </div>
                        <div id="contentRequirementsLicencia" class="content-Requirements inactive">
                            <h1>Applicants must complete Enrollment Application & comply with Licensing Requeriments</h1>
                            <p>
                                Aplicant must have experience in running an established dispensary/storefront at multiple locations.<br><br>

                                Applicant must show willingness to learn and adapt to our operating procedures as well as pass initial and post interviews.<br><br>

                                Applicant must provide list of previous work/business history especially if it pertains to the marijuana industry, or mobile industry.<br><br>

                                Applicant must provide full disclosure on business sales and current expenses, along with information pertaining to any litigations/arbitrations including any current/active business partners.
                            </p>
                        </div>
                    </div>
                    <div class="content-partner inactive" id="contentPartnerApplication">
                        <div class="row">
                            <div class="col-sm-3 opcion-content-Application sub-option-active" id="Contact">Contact Information</div>
                            <div class="col-sm-3 opcion-content-Application sub-option-inactive" id="Yourself1">About Yourself I</div>
                            <div class="col-sm-3 opcion-content-Application sub-option-inactive" id="Yourself2">About Yourself II</div>
                            <div class="col-sm-3 opcion-content-Application sub-option-inactive" id="Acknowledgement">Acknowledgement</div>
                        </div>
                        <form  method="post" action="<?= base_url() ?>home/careers" enctype="multipart/form-data">
                            <div id="contentApplicationContact" class="content-Application active">
                                <h1>Contact Information</h1>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="fname">*Legal First Name:</label>
                                            <input type="text" class="form-control" id="fname" name="fname" placeholder="Legal First Name:" required>
								        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="mname">Legal Middle Name:</label>
                                            <input type="text" class="form-control" id="mname" name="mname" placeholder="Legal Middle Name:" required>
								        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="lname">*Legal Last Name:</label>
                                            <input type="text" class="form-control" id="lname" name="lname" placeholder="Legal Last Name:" required>
								        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="Mobile">*Mobile Number:</label>
                                            <input type="text" class="form-control" id="Mobile" name="Mobile" placeholder="Mobile Number:" required>
								        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="altMobile">*Alternate Number:</label>
                                            <input type="text" class="form-control" id="altMobile" name="altMobile" placeholder="Alternate Number:" required>
								        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="email">*Email:</label>
                                            <input type="text" class="form-control" id="email" name="email" placeholder="Email:" required>
								        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="sNumber">*Street Number:</label>
                                            <input type="text" class="form-control" id="sNumber" name="sNumber" placeholder="Street Number:" required>
								        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="sName">*Street Name:</label>
                                            <input type="text" class="form-control" id="sName" name="sName" placeholder="Street Name:" required>
								        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="city">*City:</label>
                                            <input type="text" class="form-control" id="city" name="city" placeholder="City:" required>
								        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="residency">*US Residency State:</label>
                                            <select class="form-control" id="residency" name="residency" required>
                                                <option value="Alabama">Alabama</option>
                                                <option value="Alaska">Alaska</option>
                                                <option value="Arizona">Arizona</option>
                                                <option value="Arkansas">Arkansas</option>
                                                <option value="California">California</option>
                                                <option value="Colorado">Colorado</option>
                                                <option value="Connecticut">Connecticut</option>
                                                <option value="Delaware">Delaware</option>
                                                <option value="District Of Columbia">District Of Columbia</option>
                                                <option value="Florida">Florida</option>
                                                <option value="Georgia">Georgia</option>
                                                <option value="Hawaii">Hawaii</option>
                                                <option value="Idaho">Idaho</option>
                                                <option value="Illinois">Illinois</option>
                                                <option value="Indiana">Indiana</option>
                                                <option value="Iowa">Iowa</option>
                                                <option value="Kansas">Kansas</option>
                                                <option value="Kentucky">Kentucky</option>
                                                <option value="Louisiana">Louisiana</option>
                                                <option value="Maine">Maine</option>
                                                <option value="Maryland">Maryland</option>
                                                <option value="Massachusetts">Massachusetts</option>
                                                <option value="Michigan">Michigan</option>
                                                <option value="Minnesota">Minnesota</option>
                                                <option value="Mississippi">Mississippi</option>
                                                <option value="Missouri">Missouri</option>
                                                <option value="Montana">Montana</option>
                                                <option value="Nebraska">Nebraska</option>
                                                <option value="Nevada">Nevada</option>
                                                <option value="New Hampshire">New Hampshire</option>
                                                <option value="New Jersey">New Jersey</option>
                                                <option value="New Mexico">New Mexico</option>
                                                <option value="New York">New York</option>
                                                <option value="North Carolina">North Carolina</option>
                                                <option value="North Dakota">North Dakota</option>
                                                <option value="Ohio">Ohio</option>
                                                <option value="Oklahoma">Oklahoma</option>
                                                <option value="Oregon">Oregon</option>
                                                <option value="Pennsylvania">Pennsylvania</option>
                                                <option value="Rhode Island">Rhode Island</option>
                                                <option value="South Carolina">South Carolina</option>
                                                <option value="South Dakota">South Dakota</option>
                                                <option value="Tennessee">Tennessee</option>
                                                <option value="Texas">Texas</option>
                                                <option value="Utah">Utah</option>
                                                <option value="Vermont">Vermont</option>
                                                <option value="Virginia">Virginia</option>
                                                <option value="Washington">Washington</option>
                                                <option value="West Virginia">West Virginia</option>
                                                <option value="Wisconsin">Wisconsin</option>
                                                <option value="Wyoming">Wyoming</option>
                                            </select>
								        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="country">*Country:</label>
                                            <select class="form-control" id="country" name="country" required>
                                                <option value="Afganistán ">Afganistán </option>
                                                <option value="Akrotiri ">Akrotiri </option>
                                                <option value="Albania ">Albania </option>
                                                <option value="Alemania ">Alemania </option>
                                                <option value="Andorra ">Andorra </option>
                                                <option value="Angola ">Angola </option>
                                                <option value="Anguila ">Anguila </option>
                                                <option value="Antártida ">Antártida </option>
                                                <option value="Antigua y Barbuda ">Antigua y Barbuda </option>
                                                <option value="Antillas Neerlandesas ">Antillas Neerlandesas </option>
                                                <option value="Arabia Saudí ">Arabia Saudí </option>
                                                <option value="Arctic Ocean ">Arctic Ocean </option>
                                                <option value="Argelia ">Argelia </option>
                                                <option value="Argentina ">Argentina </option>
                                                <option value="Armenia ">Armenia </option>
                                                <option value="Aruba ">Aruba </option>
                                                <option value="Ashmore andCartier Islands ">Ashmore andCartier Islands </option>
                                                <option value="Atlantic Ocean ">Atlantic Ocean </option>
                                                <option value="Australia ">Australia </option>
                                                <option value="Austria ">Austria </option>
                                                <option value="Azerbaiyán ">Azerbaiyán </option>
                                                <option value="Bahamas ">Bahamas </option>
                                                <option value="Bahráin ">Bahráin </option>
                                                <option value="Bangladesh ">Bangladesh </option>
                                                <option value="Barbados ">Barbados </option>
                                                <option value="Bélgica ">Bélgica </option>
                                                <option value="Belice ">Belice </option>
                                                <option value="Benín ">Benín </option>
                                                <option value="Bermudas ">Bermudas </option>
                                                <option value="Bielorrusia ">Bielorrusia </option>
                                                <option value="Birmania Myanmar ">Birmania Myanmar </option>
                                                <option value="Bolivia ">Bolivia </option>
                                                <option value="Bosnia y Hercegovina ">Bosnia y Hercegovina </option>
                                                <option value="Botsuana ">Botsuana </option>
                                                <option value="Brasil ">Brasil </option>
                                                <option value="Brunéi ">Brunéi </option>
                                                <option value="Bulgaria ">Bulgaria </option>
                                                <option value="Burkina Faso ">Burkina Faso </option>
                                                <option value="Burundi ">Burundi </option>
                                                <option value="Bután ">Bután </option>
                                                <option value="Cabo Verde ">Cabo Verde </option>
                                                <option value="Camboya ">Camboya </option>
                                                <option value="Camerún ">Camerún </option>
                                                <option value="Canadá ">Canadá </option>
                                                <option value="Chad ">Chad </option>
                                                <option value="Chile ">Chile </option>
                                                <option value="China ">China </option>
                                                <option value="Chipre ">Chipre </option>
                                                <option value="Clipperton Island ">Clipperton Island </option>
                                                <option value="Colombia ">Colombia </option>
                                                <option value="Comoras ">Comoras </option>
                                                <option value="Congo ">Congo </option>
                                                <option value="Coral Sea Islands ">Coral Sea Islands </option>
                                                <option value="Corea del Norte ">Corea del Norte </option>
                                                <option value="Corea del Sur ">Corea del Sur </option>
                                                <option value="Costa de Marfil ">Costa de Marfil </option>
                                                <option value="Costa Rica ">Costa Rica </option>
                                                <option value="Croacia ">Croacia </option>
                                                <option value="Cuba ">Cuba </option>
                                                <option value="Dhekelia ">Dhekelia </option>
                                                <option value="Dinamarca ">Dinamarca </option>
                                                <option value="Dominica ">Dominica </option>
                                                <option value="Ecuador ">Ecuador </option>
                                                <option value="Egipto ">Egipto </option>
                                                <option value="El Salvador ">El Salvador </option>
                                                <option value="El Vaticano ">El Vaticano </option>
                                                <option value="Emiratos Árabes Unidos ">Emiratos Árabes Unidos </option>
                                                <option value="Eritrea ">Eritrea </option>
                                                <option value="Eslovaquia ">Eslovaquia </option>
                                                <option value="Eslovenia ">Eslovenia </option>
                                                <option value="España ">España </option>
                                                <option value="Estados Unidos " selected>Estados Unidos </option>
                                                <option value="Estonia ">Estonia </option>
                                                <option value="Etiopía ">Etiopía </option>
                                                <option value="Filipinas ">Filipinas </option>
                                                <option value="Finlandia ">Finlandia </option>
                                                <option value="Fiyi ">Fiyi </option>
                                                <option value="Francia ">Francia </option>
                                                <option value="Gabón ">Gabón </option>
                                                <option value="Gambia ">Gambia </option>
                                                <option value="Gaza Strip ">Gaza Strip </option>
                                                <option value="Georgia ">Georgia </option>
                                                <option value="Ghana ">Ghana </option>
                                                <option value="Gibraltar ">Gibraltar </option>
                                                <option value="Granada ">Granada </option>
                                                <option value="Grecia ">Grecia </option>
                                                <option value="Groenlandia ">Groenlandia </option>
                                                <option value="Guam ">Guam </option>
                                                <option value="Guatemala ">Guatemala </option>
                                                <option value="Guernsey ">Guernsey </option>
                                                <option value="Guinea ">Guinea </option>
                                                <option value="Guinea Ecuatorial ">Guinea Ecuatorial </option>
                                                <option value="Guinea-Bissau ">Guinea-Bissau </option>
                                                <option value="Guyana ">Guyana </option>
                                                <option value="Haití ">Haití </option>
                                                <option value="Honduras ">Honduras </option>
                                                <option value="Hong Kong ">Hong Kong </option>
                                                <option value="Hungría ">Hungría </option>
                                                <option value="India ">India </option>
                                                <option value="Indian Ocean ">Indian Ocean </option>
                                                <option value="Indonesia ">Indonesia </option>
                                                <option value="Irán ">Irán </option>
                                                <option value="Iraq ">Iraq </option>
                                                <option value="Irlanda ">Irlanda </option>
                                                <option value="Isla Bouvet ">Isla Bouvet </option>
                                                <option value="Isla Christmas ">Isla Christmas </option>
                                                <option value="Isla Norfolk ">Isla Norfolk </option>
                                                <option value="Islandia ">Islandia </option>
                                                <option value="Islas Caimán ">Islas Caimán </option>
                                                <option value="Islas Cocos ">Islas Cocos </option>
                                                <option value="Islas Cook ">Islas Cook </option>
                                                <option value="Islas Feroe ">Islas Feroe </option>
                                                <option value="Islas Georgia del Sur y Sandwich del Sur ">Islas Georgia del Sur y Sandwich del Sur </option>
                                                <option value="Islas Heard y McDonald ">Islas Heard y McDonald </option>
                                                <option value="Islas Malvinas ">Islas Malvinas </option>
                                                <option value="Islas Marianas del Norte ">Islas Marianas del Norte </option>
                                                <option value="IslasMarshall ">IslasMarshall </option>
                                                <option value="Islas Pitcairn ">Islas Pitcairn </option>
                                                <option value="Islas Salomón ">Islas Salomón </option>
                                                <option value="Islas Turcas y Caicos ">Islas Turcas y Caicos </option>
                                                <option value="Islas Vírgenes Americanas ">Islas Vírgenes Americanas </option>
                                                <option value="Islas Vírgenes Británicas ">Islas Vírgenes Británicas </option>
                                                <option value="Israel ">Israel </option>
                                                <option value="Italia ">Italia </option>
                                                <option value="Jamaica ">Jamaica </option>
                                                <option value="Jan Mayen ">Jan Mayen </option>
                                                <option value="Japón ">Japón </option>
                                                <option value="Jersey ">Jersey </option>
                                                <option value="Jordania ">Jordania </option>
                                                <option value="Kazajistán ">Kazajistán </option>
                                                <option value="Kenia ">Kenia </option>
                                                <option value="Kirguizistán ">Kirguizistán </option>
                                                <option value="Kiribati ">Kiribati </option>
                                                <option value="Kuwait ">Kuwait </option>
                                                <option value="Laos ">Laos </option>
                                                <option value="Lesoto ">Lesoto </option>
                                                <option value="Letonia ">Letonia </option>
                                                <option value="Líbano ">Líbano </option>
                                                <option value="Liberia ">Liberia </option>
                                                <option value="Libia ">Libia </option>
                                                <option value="Liechtenstein ">Liechtenstein </option>
                                                <option value="Lituania ">Lituania </option>
                                                <option value="Luxemburgo ">Luxemburgo </option>
                                                <option value="Macao ">Macao </option>
                                                <option value="Macedonia ">Macedonia </option>
                                                <option value="Madagascar ">Madagascar </option>
                                                <option value="Malasia ">Malasia </option>
                                                <option value="Malaui ">Malaui </option>
                                                <option value="Maldivas ">Maldivas </option>
                                                <option value="Malí ">Malí </option>
                                                <option value="Malta ">Malta </option>
                                                <option value="Man, Isle of ">Man, Isle of </option>
                                                <option value="Marruecos ">Marruecos </option>
                                                <option value="Mauricio ">Mauricio </option>
                                                <option value="Mauritania ">Mauritania </option>
                                                <option value="Mayotte ">Mayotte </option>
                                                <option value="México ">México </option>
                                                <option value="Micronesia ">Micronesia </option>
                                                <option value="Moldavia ">Moldavia </option>
                                                <option value="Mónaco ">Mónaco </option>
                                                <option value="Mongolia ">Mongolia </option>
                                                <option value="Montserrat ">Montserrat </option>
                                                <option value="Mozambique ">Mozambique </option>
                                                <option value="Namibia ">Namibia </option>
                                                <option value="Nauru ">Nauru </option>
                                                <option value="Navassa Island ">Navassa Island </option>
                                                <option value="Nepal ">Nepal </option>
                                                <option value="Nicaragua ">Nicaragua </option>
                                                <option value="Níger ">Níger </option>
                                                <option value="Nigeria ">Nigeria </option>
                                                <option value="Niue ">Niue </option>
                                                <option value="Noruega ">Noruega </option>
                                                <option value="Nueva Caledonia ">Nueva Caledonia </option>
                                                <option value="Nueva Zelanda ">Nueva Zelanda </option>
                                                <option value="Omán ">Omán </option>
                                                <option value="Pacific Ocean ">Pacific Ocean </option>
                                                <option value="Países Bajos ">Países Bajos </option>
                                                <option value="Pakistán ">Pakistán </option>
                                                <option value="Palaos ">Palaos </option>
                                                <option value="Panamá ">Panamá </option>
                                                <option value="Papúa-Nueva Guinea ">Papúa-Nueva Guinea </option>
                                                <option value="Paracel Islands ">Paracel Islands </option>
                                                <option value="Paraguay ">Paraguay </option>
                                                <option value="Perú ">Perú </option>
                                                <option value="Polinesia Francesa ">Polinesia Francesa </option>
                                                <option value="Polonia ">Polonia </option>
                                                <option value="Portugal ">Portugal </option>
                                                <option value="Puerto Rico ">Puerto Rico </option>
                                                <option value="Qatar ">Qatar </option>
                                                <option value="Reino Unido ">Reino Unido </option>
                                                <option value="República Centroafricana ">República Centroafricana </option>
                                                <option value="República Checa ">República Checa </option>
                                                <option value="República Democrática del Congo ">República Democrática del Congo </option>
                                                <option value="República Dominicana ">República Dominicana </option>
                                                <option value="Ruanda ">Ruanda </option>
                                                <option value="Rumania ">Rumania </option>
                                                <option value="Rusia ">Rusia </option>
                                                <option value="Sáhara Occidental ">Sáhara Occidental </option>
                                                <option value="Samoa ">Samoa </option>
                                                <option value="Samoa Americana ">Samoa Americana </option>
                                                <option value="San Cristóbal y Nieves ">San Cristóbal y Nieves </option>
                                                <option value="San Marino ">San Marino </option>
                                                <option value="San Pedro y Miquelón ">San Pedro y Miquelón </option>
                                                <option value="San Vicente y las Granadinas ">San Vicente y las Granadinas </option>
                                                <option value="Santa Helena ">Santa Helena </option>
                                                <option value="Santa Lucía ">Santa Lucía </option>
                                                <option value="Santo Tomé y Príncipe ">Santo Tomé y Príncipe </option>
                                                <option value="Senegal ">Senegal </option>
                                                <option value="Seychelles ">Seychelles </option>
                                                <option value="Sierra Leona ">Sierra Leona </option>
                                                <option value="Singapur ">Singapur </option>
                                                <option value="Siria ">Siria </option>
                                                <option value="Somalia ">Somalia </option>
                                                <option value="Southern Ocean ">Southern Ocean </option>
                                                <option value="Spratly Islands ">Spratly Islands </option>
                                                <option value="Sri Lanka ">Sri Lanka </option>
                                                <option value="Suazilandia ">Suazilandia </option>
                                                <option value="Sudáfrica ">Sudáfrica </option>
                                                <option value="Sudán ">Sudán </option>
                                                <option value="Suecia ">Suecia </option>
                                                <option value="Suiza ">Suiza </option>
                                                <option value="Surinam ">Surinam </option>
                                                <option value="Svalbard y Jan Mayen ">Svalbard y Jan Mayen </option>
                                                <option value="Tailandia ">Tailandia </option>
                                                <option value="Taiwán ">Taiwán </option>
                                                <option value="Tanzania ">Tanzania </option>
                                                <option value="Tayikistán ">Tayikistán </option>
                                                <option value="TerritorioBritánicodel Océano Indico ">TerritorioBritánicodel Océano Indico </option>
                                                <option value="Territorios Australes Franceses ">Territorios Australes Franceses </option>
                                                <option value="Timor Oriental ">Timor Oriental </option>
                                                <option value="Togo ">Togo </option>
                                                <option value="Tokelau ">Tokelau </option>
                                                <option value="Tonga ">Tonga </option>
                                                <option value="Trinidad y Tobago ">Trinidad y Tobago </option>
                                                <option value="Túnez ">Túnez </option>
                                                <option value="Turkmenistán ">Turkmenistán </option>
                                                <option value="Turquía ">Turquía </option>
                                                <option value="Tuvalu ">Tuvalu </option>
                                                <option value="Ucrania ">Ucrania </option>
                                                <option value="Uganda ">Uganda </option>
                                                <option value="Unión Europea ">Unión Europea </option>
                                                <option value="Uruguay ">Uruguay </option>
                                                <option value="Uzbekistán ">Uzbekistán </option>
                                                <option value="Vanuatu ">Vanuatu </option>
                                                <option value="Venezuela ">Venezuela </option>
                                                <option value="Vietnam ">Vietnam </option>
                                                <option value="Wake Island ">Wake Island </option>
                                                <option value="Wallis y Futuna ">Wallis y Futuna </option>
                                                <option value="West Bank ">West Bank </option>
                                                <option value="World ">World </option>
                                                <option value="Yemen ">Yemen </option>
                                                <option value="Yibuti ">Yibuti </option>
                                                <option value="Zambia ">Zambia </option>
                                                <option value="Zimbabue ">Zimbabue </option>
                                            </select>
								        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="zip">*Zip / Postal Code:</label>
                                            <input type="text" class="form-control" id="zip" name="zip" placeholder="Zip / Postal Code:" required>
								        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="contentApplicationYourself1" class="content-Application inactive">
                                <h1>Tell Us About Yourself I</h1>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="resume">Resume upload (optional):</label>
                                            <input type="file" class="form-control" id="resume" name="resume" required>
								        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="birth">*Date of Birth (mm/dd/yyyy):</label>
                                            <input type="date" class="form-control" id="birth" name="birth" placeholder="Date of Birth:" required>
								        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>*Have you ever been contracted by Med ConnexApp?</label>
                                            <input class="form-check-input" type="radio" name="contracted" id="contracted1" value="Yes">
                                            <label class="form-check-label" for="contracted1">
                                                Yes
                                            </label>
                                            <input class="form-check-input" type="radio" name="contracted" id="contracted2" value="No">
                                            <label class="form-check-label" for="contracted2">
                                                No
                                            </label>
								        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>*Are You a U.S. military veteran?</label><br>
                                            <input class="form-check-input" type="radio" name="veteran" id="veteran1" value="Yes">
                                            <label class="form-check-label" for="veteran1">
                                                Yes
                                            </label>
                                            <input class="form-check-input" type="radio" name="veteran" id="veteran2" value="No">
                                            <label class="form-check-label" for="veteran2">
                                                No
                                            </label>
								        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="addressStore">Address of store or store number(s):</label>
                                            <textarea class="form-control" name="addressStore" id="addressStore" rows="3" placeholder="Address of store or store number(s):" style="resize:none;"></textarea>
								        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="mStatus">Military Status:</label><br>
                                            <select class="form-control" id="mStatus" name="mStatus" required>
                                                <option value="">Select a option:</option>
                                                <option value="Army">Army</option>
                                                <option value="Navy">Navy</option>
                                                <option value="Marines">Marines</option>
                                                <option value="Air Force">Air Force</option>
                                                <option value="Reserves">Reserves</option>
                                                <option value="Other">Other</option>
                                            </select><br>
                                            <input type="text" class="form-control inactive" id="otherMStatus" name="otherMStatus" placeholder="Other Military Status:" required>
								        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="addressStore">Employment details (location and title):</label>
                                            <textarea class="form-control" name="addressStore" id="addressStore" rows="3" placeholder="Employment details (location and title):" style="resize:none"></textarea>
								        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="experience">*How many years of retail experience do you have?</label><br>
                                            <input type="text" class="form-control" id="experience" name="experience" placeholder="How many years of retail experience do you have?" required>
								        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>*Will your spouse be on Med Connex App?</label><br>
                                            <input class="form-check-input" type="radio" name="spouse" id="spouse1" value="Yes">
                                            <label class="form-check-label" for="spouse1">
                                                Yes
                                            </label>
                                            <input class="form-check-input" type="radio" name="spouse" id="spouse2" value="No">
                                            <label class="form-check-label" for="spouse2">
                                                No
                                            </label>
								        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="experienceManagement">*How many years of management experience do you have?</label><br>
                                            <input type="text" class="form-control" id="experienceManagement" name="experienceManagement" placeholder="How many years of management experience do you have?" required>
								        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="contentApplicationYourself2" class="content-Application inactive">
                                <h1>Tell Us About Yourself II</h1>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="firstNameSpouse">Spouse First Name:</label><br>
                                            <input type="text" class="form-control" id="firstNameSpouse" name="firstNameSpouse" placeholder="Spouse First Name:" required>
								        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>*Do you have firing or hiring experience?</label><br>
                                            <input class="form-check-input" type="radio" name="firing" id="firing1" value="Yes">
                                            <label class="form-check-label" for="firing1">
                                                Yes
                                            </label>
                                            <input class="form-check-input" type="radio" name="firing" id="firing2" value="No">
                                            <label class="form-check-label" for="firing2">
                                                No
                                            </label>
								        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="middleNameSpouse">Spouse Middle Name:</label><br>
                                            <input type="text" class="form-control" id="middleNameSpouse" name="middleNameSpouse" placeholder="Spouse Middle Name:" required>
								        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="operateBusiness">*Describe how you will operate your business:</label>
                                            <textarea class="form-control" name="operateBusiness" id="operateBusiness" rows="3" placeholder="Describe how you will operate your business:" style="resize:none"></textarea>
								        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="lastNameSpouse">Spouse Last Name:</label><br>
                                            <input type="text" class="form-control" id="lastNameSpouse" name="lastNameSpouse" placeholder="Spouse Last Name:" required>
								        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="experienceQualification">*Describe your experience and qualification:</label>
                                            <textarea class="form-control" name="experienceQualification" id="experienceQualification" rows="3" placeholder="Describe your experience and qualification:" style="resize:none"></textarea>
								        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="spouseDateBirth">Spouse's Date of Birth (mm/dd/yyyy):</label><br>
                                            <input type="date" class="form-control" id="spouseDateBirth" name="spouseDateBirth" placeholder="Spouse's Date of Birth (mm/dd/yyyy):" required>
								        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="invest">*What is the maximum you are able to invest in this business opportunity? (i.e. 401k)</label><br>
                                            <input type="text" class="form-control" id="invest" name="invest" placeholder="What is the maximum you are able to invest in this business opportunity? (i.e. 401k)" required>
								        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="liquid">*How much of the investment is liquid? (cash or checking or saving account)</label><br>
                                            <input type="text" class="form-control" id="liquid" name="liquid" placeholder="How much of the investment is liquid? (cash or checking or saving account)" required>
								        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>*Are you able to dedicate full-time managing and working at the store?</label><br>
                                            <input class="form-check-input" type="radio" name="fullTime" id="fullTime1" value="Yes">
                                            <label class="form-check-label" for="fullTime1">
                                                Yes
                                            </label>
                                            <input class="form-check-input" type="radio" name="fullTime" id="fullTime2" value="No">
                                            <label class="form-check-label" for="fullTime2">
                                                No
                                            </label>
								        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="contentApplicationAcknowledgement" class="content-Application inactive">
                                <h1>Acknowledgement</h1>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <p>
                                            I/WE recognize that Med Connex., is not in any way obligated to franchise a Med Connex store to ME/US because of MY/OUR execution of this document. I/WE acknowledge that any false statement on this application shall be considered sufficient cause to deny any further consideration or cause revocation of any signed agreement with Med Connex. I/WE understand that any inquiry regarding MY/OUR character, general reputation, personal characteristics, financial background and general fitness for being a Med Connex Franchisee may be made as a result of this application. In addition, by signing below I/WE release any and all former and/or present employers, and any other personal or business references, from any liability whatsoever in connection with Med Connex;s attempt to investigate MY/OUR background and determine MY/OUR fitness to become a Med Connex Franchisee. I/WE specifically authorize Med Connex to obtain credit reports from one or more credit bureaus and background check on ME/US and MY/OUR business(es). A copy of this authorization may be used in place of and shall be valid as the original. I/WE understand that this application is considered active for 180 days from the date below. By submitting this application I/WE agree that this information is correct and I/WE give Med Connex., permission to obtain a Credit Report and Background Report for the individuals listed on this application. I understand and acknowledge that if I am married but do not provide complete information for myself and my spouse, 7-Eleven, Inc. cannot process this application.
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="agree" name="agree">
                                            <label class="form-check-label" for="agree">*I/WE Agree</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="form-group">
                                            <label for="signature">*Applicant's Signature:</label><br>
                                            <input type="text" class="form-control" id="signature" name="signature" placeholder="Applicant's Signature:" required>
								        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12" style="text-align: center;">
                                        <button type="submit" class="btn btn-default">Submit</button> 
                                        <button type="reset" class="btn btn-default">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
            
    <div class="row">
                    
        <div class="col-lg-8 medconnex1" style="background: #fff;">
    <div class="tab-pane fade in active" id="calendars">
                            <div id="calendars" class="tab-pane fade in active">
                                <div id="calendar"></div>
                            </div>
                        </div>
        <!--             <div class="medconnex-right" align="right">
                        <form method="post" action="">
                            <div class="btn-group medconnexgrp">
                                <input type="text" id="startdate_graph" name="startdate" class="form-control datetimepicker4" placeholder="Start Date" size="18">
                            </div>
                            <div class="btn-group medconnexgrp">
                                <input type="text" id="enddate_graph" name="enddate" class="form-control datetimepicker4" placeholder="End Date" size="18">
                            </div>
                            <div class="btn-group medconnexgrp">
                                <input type="submit" class="btn btn-primary" value="submit">
                            </div>
                        </form>
                    </div>
            <div class="panel panel-default medconnex-panel">
                <div class="panel-heading adi-head-blue2 medconnex-panelheading">
                    <i class="fa fa-bar-chart-o fa-fw"></i> Charts : 
                    <button type="button" class="btn btn-primary tabcharts firstClick"   data-chartid="morris-area-chart">Mobile Devices</button>
                    <button type="button" class="btn btn-default tabcharts"   data-chartid="user-type-chart">Certified Providers</button>
                    <button type="button" class="btn btn-default tabcharts"   data-chartid="provider-usertype-chart">App Users VS Certified Providers</button>


                </div>
                <div class="panel-body medconnex-panelbody" >
                    <div class="tab-content medconnex-tab">
                        <div class="tab-pane active medconnex-pane">
                            <div id="morris-area-chart" class="chartuser updateidchart"></div>
                        </div>
                      
                         
                    </div>
                </div>
            </div> -->

        </div>

        <!-- /.col-lg-8 -->
        <div class="col-lg-4 medconnex2">
            <div class="panel panel-default medconnex2-panel" style="display: none;">
                <div class="panel-heading adi-head-per2 medconnex2-heading">
                    <i class="fa fa-bell fa-fw"></i> Notifications Panel
                </div>
                <div class="panel-body medconnex2-body">
                    <div class="list-group medconnex2-listgrp">
                        <div id="notificationsinpdex_notiy"></div>
                    </div>
                </div>
            </div>


            <h4 style="text-align: center;color: black;font-weight: bold;text-transform: uppercase; background-color: white;padding: 10px;margin: 0px;">Chat list</h4>

            <div class="panel panel-default chatList">
                <?php
                $adminCount = count($allAdmins);
                if ($adminCount > 0) {
                    foreach ($allAdmins as $all) {
                        ?>

                        <div class="panel-heading adi-head-orange2" onclick="getChatPanel('<?= $all->id ?>');" style="background-color: green !important;cursor:pointer;">

                            <i class="fa fa-comments fa-fw"></i> User Chat  <?= ucfirst($all->email) ?>
                        </div>
                    <?php
                    }
                }
                ?>
            </div>


        </div>
        <div class="clearfix"></div>
        <div class="row " id="scr">
            <?php
            $adminCount = count($allAdmins);
            if ($adminCount > 0) {
                foreach ($allAdmins as $all) {
                    ?>
                    <div class="col-md-4 pull-right allchatboxes" id="chatpanel<?= $all->id ?>" style="display: none;" >
                        <div class="chat-panel panel panel-default">
                            <div class="panel-heading adi-head-orange2">
                                <i class="fa fa-comments fa-fw"></i> User chat <?= ucfirst($all->email) ?>
                                <a class="close" data-dismiss="alert" aria-label="close" onclick="getCloseChatPanel('<?= $all->id ?>')">&times;</a>
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <ul class="chat" id="chat-messages-inner<?= $all->id ?>">
                                    There is a No Messages
                                </ul>
                            </div>
                            <div class="panel-footer">
                                <form action="" id="msg<?= $all->id ?>" name="msg<?= $all->id ?>" enctype="multipart/form-data" method="post" onsubmit="return false;">
                                    <div class="input-group">
                                        <input  name="message"  id="message<?= $all->id ?>"  style="padding:15px; height:auto;" class="form-control input-sm" placeholder="Type your message here..." type="text">
                                        <input type="hidden" name="id" value="<?= $all->id ?>">
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn btn-warning btn-sm adi-head-orange " id="btn-chat<?= $all->id ?>" onclick="messageSend('<?= $all->id ?>');">
                                                <span><i class="fa fa-paper-plane" aria-hidden="true"></i></span>
                                            </button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>



                <?php
                }
            }
            ?>




            <!-- Modal -->
            <div class="modal fade" id="get_user_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header title-bar-orange">
                            <h5 style="color:#fff;width:93%;float:left;font-weight: bold;" class="modal-title" id="exampleModalLabel"><span class="usernamepopup"></span> Details</h5>
                            <button style="width:6%;float:left;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span style="color:#fff;font-size: 20px;font-weight: bold;" aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form name="user" method="post" action="" >
                                <div id="form-alerts">
                                </div>
                                <div class="row">
                                    <div class="view_user_details">

                                    </div>     

                                </div><br>
                                <div class="modal-footer">
                                    <div class="row">
                                        <div class="creatUserBottom">
                                            <div class="">
                                                <div class="vert-pad">
                                                    <button type="button" class="btn-grey" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>  

                </div>
            </div>      

            
            <script type="text/javascript">
                function getChatPanel(id) {
                    var chatid = "#chatpanel" + id;
                    var chatmessage = "#chat-messages-inner" + id;
                    //$('.allchatboxes').hide();
                    $(chatid).show();
                    $("html, body").animate({scrollTop: $(document).height()}, 1000);
                    $("#chatmessage,.panel-body").animate({scrollTop: $(document).height()}, 1000);
                }
                function getCloseChatPanel(id) {
                    var chatid = "#chatpanel" + id;
                    $(chatid).hide();
                }
            </script>
            <!-- Morris Charts JavaScript -->
            <script src="<?php echo base_url(); ?>public/vendor/raphael/raphael.min.js"></script>
            <script src="<?php echo base_url(); ?>public/vendor/morrisjs/morris.min.js"></script>

            <script>
                //$("#chat-messages-inner").animate({scrollTop: $(document).height()}, "slow");
                function messageSend(id) {
                    var meg = $("#message" + id).val();
                    //var file1     =   $("#file1").val();
                    //alert(meg);
                    var errorcount = 0;



                    if ($("#message" + id).val() == "") {
                        $("#message" + id).focus();
                        $("#message" + id).css({'border': "1px solid #ff0000"});
                        errorcount = 1;
                    } else {
                        $("#message" + id).css({'border': "1px solid #d1d1d1"});
                    }
                    if (errorcount == 1)
                    {
                        return false;
                    }

                    var form = document.getElementById("msg" + id);
                    var datastring = $("#msg" + id).serialize();
                    console.log(datastring);
                    //var form=$("#msg");
                    $.ajax({
                        type: "post",
                        url: "<?php echo base_url(); ?>panels/supermacdaddy/storefronts/sendmassage",
                        //data: datastring+"&message="+meg,
                        data: new FormData(form),
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (data)
                        {
                            //alert(response);
                            console.log(data);
                            /*$("#mesage").html(response);*/
                            document.getElementById("msg" + id).reset();
                        }

                    });
                }


                function sendMessageClick(id)
                {
                    $('.send_id').val(id);
                }
               

                $(document).on('click', '.chat li', function () {
                    if ($(this).hasClass('blue')) {
                        //$(this). removeClass('blue');
                        $('.chat li').removeClass('blue');
                    } else
                    {
                        $('.chat li').removeClass('blue');
                        $(this).addClass('blue');
                    }
                });




                $(document).ready(function() {

                    chart1();
                    $('.tabcharts').click(function () {
                        var checkid = $(this).attr('data-chartid');
                      //  alert(checkid);
                        $('.updateidchart').attr('id', checkid);
                        $('.updateidchart').html('');
                        $('.updateidchart').attr('id', checkid);

                        $('.tabcharts').each(function () {
                            $(this).removeClass("btn-primary");
                            $(this).addClass("btn-default");
                        });
                        $(this).addClass("btn-primary");
                        if (checkid == "morris-area-chart") {
                            chart1();
                        } else if (checkid == "user-type-chart") {
                            chart2();
                        } else if (checkid == "provider-usertype-chart") {
                            chart3();
                        }
                    });


                    function chart1()
                    {
                       // alert('chart1');

                        Morris.Area({
                            element: 'morris-area-chart',
                            data: [<?php
            foreach ($usercount as $value) {
                echo "{period: '" . $value['dates'] . "', ios:'" . $value['ios'] . "', android:'" . $value['android'] . "',},";
            }
            ?>],
                            xkey: 'period',
                            ykeys: ['ios', 'android'],
                            labels: ['iOS', 'Android'],
                            pointSize: 2,
                            hideHover: 'auto',
                            resize: true
                        });
                    }
                    function chart2()
                    {
                        //  alert('chart2');

                        Morris.Area({
                            element: 'user-type-chart',
                            data: [<?php
            foreach ($usertype_count as $value) {
                echo "{period: '" . $value['dates'] . "', store:'" . $value['store_count'] . "', doctor:'" . $value['docotor_count'] . "', driver:'" . $value['driver_count'] . "',},";
            }
            ?>],
                            xkey: 'period',
                            ykeys: ['store', 'doctor', 'driver'],
                            labels: ['Store', 'Doctor', 'Driver'],
                            pointSize: 3,
                            hideHover: 'auto',
                            resize: true
                        });
                    }


                    function chart3()
                    {
                       // alert('chart3');

                        Morris.Area({
                            element: 'provider-usertype-chart',
                            data: [<?php
            foreach ($provider_usertype_count as $value) {
                echo "{period: '" . $value['dates'] . "', provider:'" . $value['provider'] . "', user:'" . $value['users'] . "',},";
            }
            ?>],
                            xkey: 'period',
                            ykeys: ['provider', 'user'],
                            labels: ['Provider', 'User'],
                            pointSize: 2,
                            hideHover: 'auto',
                            resize: true
                        });
                    }
                });
            </script>
            <script>
                $("#chat-messages-inner").animate({scrollTop: $(document).height()}, "slow");


                $(document).ready(function () {
                    $(".datetimepicker4").datepicker({
                        format: 'yyyy-mm-dd',
                        autoclose: true,
                        orientation: "bottom"
                    });


                    $("#enddate_graph").change(function () {
                        var startDate = document.getElementById("startdate_graph").value;
                        var endDate = document.getElementById("enddate_graph").value;

                        if ((Date.parse(endDate) <= Date.parse(startDate))) {
                            alert("End date should be greater than Start date");
                            document.getElementById("enddate_graph").value = "";
                        }
                    });

                    setInterval(function () {
                        $.ajax({
                            type: "post",
                            url: "<?php echo base_url(); ?>panels/supermacdaddy/storefronts/chat_history",
                            data: "",
                            success: function (response)
                            {
                                /*alert(response);*/
                                var responses = $.parseJSON(response);
                                $.each(responses, function (key, value) {
                                    //For example
                                    $("#chat-messages-inner" + key).html(value);
                                });

                                if (response == "") {
                                    $(".settle-btn").css("display", "none");
                                } else {
                                    $(".settle-btn").css("display", "block");
                                    if (response != "") {

                                        $("#settleyes").html(response);
                                        $("#settlerequest").attr('disabled', true);

                                    } else {
                                        $("#settleyes").html("Yes It's Settle ?");
                                    }
                                }
                            }

                        });
                    }, 2000);



                });
                $(document).ready(function () {
                    $('#ratingClick').click();
                    $('.firstClick').click();

                })

            </script> 
