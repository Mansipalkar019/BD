<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="BDS DATABASE PROJECT">
    <meta name="author" content="Mohammed Sufian Shaikh">
    <link href="https://bdsserv.com/assets/icon/fv.png" rel="icon">
    <title>All Informations | BD-CRM</title>

    <link href="<?php echo base_url();?>public/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        /* Show it is fixed to the top */
        body {
            min-height: 45rem;
            padding-top: 4.5rem;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" 
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $(function() {});
    </script>
</head>

<body class="">


<style>
pre {
    /* white-space:pre-line; */
    white-space: pre-wrap;       /* Since CSS 2.1 */
    white-space: -moz-pre-wrap;  /* Mozilla, since 1999 */
    white-space: -pre-wrap;      /* Opera 4-6 */
    white-space: -o-pre-wrap;    /* Opera 7 */
    word-wrap: break-word;       /* Internet Explorer 5.5+ */
    font-size: 11px;
}
.card-body p { font-size:12.11px; }
.card-header { font-size: 0.7rem!important; }

html, body
{
    overflow: hidden;
    height: 100%;
}
body { padding: 1px;  }
.container-fluid { padding: 0px; margin: 0px; } /*padding-top: 55px;*/
.row1
{
    overflow-y: scroll;
    overflow-x: hidden;
}

.col-form-label
{
    font-size: 13px;
}

</style>

<main class="container-fluid" style="background-color: #FFFFEA;">
    <div class="row row1">
        <div class="col">
            <div class="row g-3 align-items-center justify-content-md-center">
                <div class="col">
                    <label for="company_received" class="col-form-label">Co. Name Recd:</label>
                </div>
                <div class="col">
                    <input type="text" value="" title="" id="company_received"  name='company_received' class="form-control form-control-sm" disabled>
                </div>
            </div>
            <div class="row g-3 align-items-center justify-content-md-center">
                <div class="col">
                    <label for="company_name" class="col-form-label">Co. Name:</label>
                </div>
                <div class="col">
                    <input type="text" value="" title="" id="company_name"  name='company_name' class="form-control form-control-sm">
                </div>
            </div>
            <div class="row g-3 align-items-center justify-content-md-center">

                <div class="col">
                    <label for="address_1" class="col-form-label">Address:</label>
                    <input type="text" value="" title="" id="address_1"  name='address_1' class="form-control form-control-sm">
                </div>
                <div class="col">
                    <label for="address_2" class="col-form-label">Address 2:</label>
                    <input type="text" value="" title="" id="address_2"  name='address_2' class="form-control form-control-sm">
                </div>
                <div class="col">
                    <label for="address_3" class="col-form-label">Address 3:</label>
                    <input type="text" value="" title="" id="address_3"  name='address_3' class="form-control form-control-sm">
                </div>
            </div>


            <div class="row g-3 align-items-center justify-content-md-center">
                <div class="col">
                    <label for="city" class="col-form-label">City:</label>
                    <input type="text" value="" title="" id="city"  name='city' class="form-control form-control-sm">
                </div>
                <div class="col">
                    <label for="postal_code" class="col-form-label">Postal Code:</label>
                    <input type="text" value="" title="" id="postal_code"  name='postal_code' class="form-control form-control-sm">
                </div>
                <div class="col">
                    <label for="state_county" class="col-form-label">State/County:</label>
                    <input type="text" value="" title="" id="state_county"  name='state_county' class="form-control form-control-sm">
                </div>
            </div>

            <div class="row g-3 align-items-center justify-content-md-center">
                <div class="col">
                  <label for="country" class="col-form-label">Country:</label>
                    <select class='form-control form-control-sm' id="country"  name='country'>
                       <option value=''>Select Country</option>
                        <?php 
                        foreach ($country as $key => $val) { ?>
                           <option value='<?= $val['id']; ?>'><?= $val['name']; ?></option>
                        <?php }
                    ?>
                    </select>
                </div>

                <div class="col">
                    <label for="region" class="col-form-label">Region:</label>
                    <input type="text" value="" title="" id="region"  name='region' class="form-control form-control-sm">
                </div>
                <div class="col">
                    <label for="address_url" class="col-form-label" style="font-size: 0.7rem;">Address Source URL:</label>
                    <input type="text" value="" title="" id="address_url"  name='address_url' class="form-control form-control-sm">
                </div>
            </div>

            <div class="row g-3 align-items-center justify-content-md-center">
                <div class="col">
                    <label for="ca1" class="col-form-label">CA1:</label>
                    <input type="text" value="" title="" id="ca1"  name='ca1' class="form-control form-control-sm">
                </div>
                <div class="col">
                    <label for="ca2" class="col-form-label">CA2:</label>
                    <input type="text" value="" title="" id="ca2"  name='ca2' class="form-control form-control-sm">
                </div>

                <div class="col">
                    <label for="ca3" class="col-form-label">CA3:</label>
                    <input type="text" value="" title="" id="ca3"  name='ca3' class="form-control form-control-sm">
                </div>

                <div class="col">
                    <label for="ca4" class="col-form-label">CA4:</label>
                    <input type="text" value="" title="" id="ca4"  name='ca4' class="form-control form-control-sm">
                </div>
                <div class="col">
                    <label for="ca5" class="col-form-label">CA5:</label>
                    <input type="text" value="" title="" id="ca5"  name='ca5' class="form-control form-control-sm">
                </div>
            </div>
        </div>


        <div class="col">

            <div class="alert alert-warning text-center p-1" role="alert">(BTB-02-T) / (NMD) / (<a data-bs-toggle="modal" data-bs-target="#briefDetails" href="#" class="text-underline">CO. BRIEF</a>)</div>
            <div class="modal fade" id="briefDetails" tabindex="-1" aria-labelledby="briefDetailsLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header"><h5 class="modal-title" id="briefDetailsLabel">Project - Company Brief</h5></div>
                        <div class="modal-body text-center"><b>bbbb</b></div>
                        <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button></div>
                    </div>
                </div>
            </div>
            <div class="row g-3 align-items-center justify-content-md-center">
                <div class="col">
                    <label for="company_disposition" class="col-form-label">Co. Disposition:</label>
                </div>
                <div class="col">
                <select class='form-control form-control-sm' id="company_disposition"  name='company_disposition'>
                   <option value=''>Select Co. Disposition</option>
                    <?php 
                        foreach ($compDispo as $key => $val) { ?>
                           <option value='<?= $val['id']; ?>'><?= $val['company_dispostion']; ?></option>
                        <?php }

                    ?>
                </select>
                </div>
            </div>

            <div class="row g-3 align-items-center justify-content-md-center">
                <div class="col">
                    <label for="web_disposition" class="col-form-label">Co. Web Disposition:</label>
                </div>
                <div class="col">
                    <select class='form-control form-control-sm' id="web_disposition"  name='web_disposition'>
                        <option value=''>Select Web Disposition</option>
                        <?php 
                        foreach ($webDispo as $key => $val) { ?>
                           <option value='<?= $val['id']; ?>'><?= $val['web_disposition_name']; ?></option>
                        <?php }

                    ?>
                    </select>
                </div>
            </div>

            <div class="row g-3 align-items-center justify-content-md-center">
                <div class="col">
                    <label for="voice_disposition" class="col-form-label">Co. Voice Disposition:</label>
                </div>
                <div class="col">
                      <select class='form-control form-control-sm' id="voice_disposition"  name='voice_disposition'>
                        <option value=''>Select Voice Disposition</option>
                        <?php 
                        foreach ($VoiceDispo as $key => $val) { ?>
                           <option value='<?= $val['id']; ?>'><?= $val['caller_disposition']; ?></option>
                        <?php }

                    ?>
                     </select>
                </div>
            </div>

            <style>
                .incomplete_disposition { display: none; }
            </style>

            <div class="incomplete_disposition">
            <div class="row g-3 align-items-center justify-content-md-center">
                <div class="col">
                    <label for="incomplete_disposition" class="col-form-label">Incomplete Disposition:</label>
                </div>
                <div class="col">
                   <select class='form-control form-control-sm' id="incomplete_disposition"  name='incomplete_disposition'>

                    <option value=''>select Incomplete Disposition</option>
                    <option value='No Answer'>No Answer</option>
                    <option value='Number Unobtainable'>Number Unobtainable</option>
                    <option value='Engaged'>Engaged</option>
                    <option value='No Longer Trading'>No Longer Trading</option>
                    <option value='Wrong Number'>Wrong Number</option>
                    <option value='Language Issue'>Language Issue</option><option value='RNU'>RNU</option></select>
                </div>
            </div>
            </div>


            <div class="row g-3 align-items-center justify-content-md-center">
                <div class="col">
                    <label for="general_notes" class="col-form-label">Co. General Notes:</label>
                </div>
                <div class="col">
                    <input type="text" value="" title="" id="general_notes"  name='general_notes' class="form-control form-control-sm">
                </div>
            </div>

            <div class="row g-3 align-items-center justify-content-md-center">
                <div class="col">
                    <label for="remarks" class="col-form-label">Co. Remark:</label>
                </div>
                <div class="col">
                    <textarea title="" id="remarks"  name='remarks' class="form-control form-control-sm"></textarea>
                </div>
            </div>

            <div class="row g3 justify-content-md-center mt-4">
                <div class="col-auto">
                    <div class="input-group mb-3">
                        <a class="btn btn-outline-secondary btn-sm" href="#" title="First" id="first"><<</a>
                        <a class="btn btn-outline-secondary btn-sm" href="#" title="Previous" id="prev"><</a>
                        <input type="text" class="form-control form-control-sm text-center" placeholder="Co. Id" size="6" value="61" title="61" disabled>
                        <a class="btn btn-outline-secondary btn-sm" href="#" title="Next" id="next">></a>
                        <a class="btn btn-outline-secondary btn-sm" href="#" title="Last" id="last">>></a>
                    </div>
                </div>
                <div class="col-auto">
                    <button class="btn btn-outline-primary btn-sm" type="button" id="update_company">Update</button>
                </div>
            </div>

        </div>

        <div class="col">
            <div class="row g-3 align-items-center justify-content-md-center">
                <div class="col">
                    <label for="country_code" class="col-form-label">Country Code:</label>
                    <input type="number" value="" title="" id="country_code"  name='country_code' class="form-control form-control-sm" readonly>
                </div>

                <div class="col">
                    <label for="area_code" class="col-form-label">Area Code:</label>
                    <input type="number" value="" title="" id="area_code"  name='area_code' class="form-control form-control-sm" size="6">
                </div>

                <div class="col-auto">
                    <label for="telephone_number" class="col-form-label">Telephone Number:</label>
                    <input type="number" value="2 2403 3856" title="2 2403 3856" id="telephone_number"  name='telephone_number' class="form-control form-control-sm">
                </div>
            </div>

            <div class="row g-3 align-items-center justify-content-md-center">
                <div class="col">
                    <label for="alternate_number" class="col-form-label">Alternate Number:</label>
                    <input type="number" value="" title="" id="alternate_number"  name='alternate_number' class="form-control form-control-sm">
                </div>
                <div class="col">
                    <label for="fax_number" class="col-form-label">Fax Number:</label>
                    <input type="number" value="" title="" id="fax_number"  name='fax_number' class="form-control form-control-sm">
                </div>
                <div class="col">
                    <label for="website_url" class="col-form-label">Website URL:</label>
                    <input type="text" value="" title="" id="website_url"  name='website_url' class="form-control form-control-sm">
                </div>
            </div>


            <div class="row g-3 align-items-center justify-content-md-center">
                <div class="col">
                    <label for="email_address" class="col-form-label">Email Address:</label>
                    <input type="email" value="" title="" id="email_address"  name='email_address' class="form-control form-control-sm">
                </div>

                

                <div class="col">
                    <label for="no_of_employees" class="col-form-label">No. of Employees:</label>
                    <input type="number" value="" title="" id="no_of_employees"  name='no_of_employees' class="form-control form-control-sm">
                </div>
            </div>

            <div class="row g-3 align-items-center justify-content-md-center">
                
                <div class="col">
                    <label for="sic_code" class="col-form-label">SIC Code:</label>
                    <input type="text" value="" title="" id="sic_code"  name='sic_code' class="form-control form-control-sm">
                </div>
                <div class="col">
                    <label for="sic_description" class="col-form-label">SIC Description:</label>
                    <input type="text" value="" title="" id="sic_description"  name='sic_description' class="form-control form-control-sm">
                </div>
            </div>


            <div class="row g-3 align-items-center justify-content-md-center">
                <div class="col">
                    <label for="industry" class="col-form-label">Industry:</label>
                    <input type="text" value="" title="" id="industry"  name='industry' class="form-control form-control-sm">
                </div>

                <div class="col">
                <label for="revenue" class="col-form-label">Revenue:</label>
                    <div class="input-group">
                        <input type="number" value="" title="" id="revenue"  name='revenue' class="form-control form-control-sm">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="revenue_currency">$</button>


                     <ul class="dropdown-menu dropdown-menu-end revenue_currency">
                        <?php 
                        foreach ($currency as $key => $val) { ?>
                             <li><a href="#" class="dropdown-item"><?= $val['currency_name']." (".$val['currency_symbol'].")";?></a></li>
                       <?php }

                        ?>
                    </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>







    <div class="row row1">

        <div class="col">

            <div class="row g-3 align-items-center justify-content-md-center">
                <div class="col">
                    <label for="title" class="col-form-label">Title:</label>
                        <select class='form-control form-control-sm' id="title"  name='title'>
                            <option value=''>select a title</option>
                            <option value='Mr' selected>Mr</option>
                            <option value='Ms'>Ms</option>
                            <option value='Mrs'>Mrs</option>
                            <option value='Dr'>Dr</option>
                            <option value='Prof'>Prof</option>
                            <option value='Capt'>Capt</option>
                            <option value='HE'>HE</option>
                            <option value='HH'>HH</option>
                            <option value='Sir'>Sir</option>
                            <option value='Madam'>Madam</option>
                            <option value='Maam'>Ma'am</option>
                        </select>
                </div>

                <div class="col">
                    <label for="first_name" class="col-form-label">First Name:</label>
                    <input type="text" value="" title="" id="first_name"  name='first_name' class="form-control form-control-sm">
                </div>

                <div class="col">
                    <label for="last_name" class="col-form-label">Last Name:</label>
                    <input type="text" value="" title="Abdelmohdi" id="last_name"  name='last_name' class="form-control form-control-sm">
                </div>
            </div>

            <div class="row g-3 align-items-center justify-content-md-center">
                <div class="col">
                    <label for="job_title" class="col-form-label">Job Title:</label>
                </div>
                <div class="col">
                    <input type="text" value="" title="" id="job_title"  name='job_title' class="form-control form-control-sm">
                </div>
            </div>
            
            <div class="row g-3 align-items-center justify-content-md-center">
                <div class="col">
                    <label for="staff_job_function" class="col-form-label">Job Function:</label>
                </div>
                <div class="col">
                    <input type="text" value="" title="" id="staff_job_function"  name='staff_job_function' class="form-control form-control-sm">
                </div>
            </div>

            <div class="row g-3 align-items-center justify-content-md-center">
                <div class="col">
                    <label for="staff_email" class="col-form-label">Staff Email:</label>
                </div>
                <div class="col">
                    <div class="input-group">
                        <input type="email" value="" title="" id="staff_email"  name='staff_email' class="form-control form-control-sm">
                        <div class="input-group-text">
                            <input class="form-check-input mt-0" type="checkbox" value="Verified" id="staff_email_verified" >
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-3 align-items-center justify-content-md-center">
                <div class="col">
                    <label for="staff_department" class="col-form-label">Staff Department:</label>
                </div>
                <div class="col">
                    <input type="text" value="" title="" id="staff_department"  name='staff_department' class="form-control form-control-sm">
                </div>
            </div>

            <div class="row g-3 align-items-center justify-content-md-center">
                <div class="col">
                    <label for="staff_url" class="col-form-label">Staff Source URL:</label>
                </div>
                <div class="col">
                    <input type="text" value="" title="" id="staff_url"  name='staff_url' class="form-control form-control-sm">
                </div>
            </div>

            <div class="row g-3 align-items-center justify-content-md-center">
                <div class="col">
                    <label for="assumed_email" class="col-form-label">Assumed Email:</label>
                </div>
                <div class="col">
                    <input type="email" value="" title="" id="assumed_email"  name='assumed_email' class="form-control form-control-sm">
                </div>
            </div>

            <div class="row g-3 align-items-center justify-content-md-center">
                <div class="col">
                    <label for="staff_email_harvesting" class="col-form-label">Email Source URL:</label>
                </div>
                <div class="col">
                    <input type="text" value="Clearbit" title="Clearbit" id="staff_email_harvesting"  name='staff_email_harvesting' class="form-control form-control-sm">
                </div>
            </div>

            <div class="row g-3 align-items-center justify-content-md-center">
                <div class="col">
                    <label for="staff_direct_tel" class="col-form-label">Direct Tel:</label>
                    <input type="text" value="" title="" id="staff_direct_tel"  name='staff_direct_tel' class="form-control form-control-sm">
                </div>
                <div class="col">
                    <label for="staff_extension" class="col-form-label">Extension:</label>
                    <input type="text" value="" title="" id="staff_extension"  name='staff_extension' class="form-control form-control-sm">
                </div>

                <div class="col">
                    <label for="staff_mobile" class="col-form-label">Mobile:</label>
                    <input type="text" value="" title="" id="staff_mobile"  name='staff_mobile' class="form-control form-control-sm">
                </div>
            </div>

            <br><br><br>
        </div>



        <div class="col">
            <div class="alert alert-warning text-center p-1">
                        Staff Details
             / <a class="text-underline" data-bs-toggle="modal" data-bs-target="#providedJobTitle" id="provided_job_title" href="#">P. JT</a>            
            
                        <div class="modal fade" id="providedJobTitle" tabindex="-1" aria-labelledby="providedJobTitleLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="providedJobTitleLabel">Provided Job Title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <h5><span class="badge bg-danger">Business Applications Manager</span></h5>                    </div>
                    <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button></div>
                    </div>
                </div>
            </div>
                        </div>


            <div class="row g-3 align-items-center justify-content-md-center">
                <div class="col">
                    <label for="web_staff_disposition" class="col-form-label">Web Staff Disposition:</label>
                </div>
                <div class="col">
                    <select class='form-control form-control-sm' id="web_staff_disposition"  name='web_staff_disposition'>

                        <option value=''>select Web Disposition</option>
                        <option value='Verified' selected>Verified</option>
                        <option value='Acquired'>Acquired</option>
                        <option value='Staff Left'>Staff Left</option>
                        <option value='Replaced'>Replaced</option>
                        <option value='Added'>Added</option>
                        <option value='No Result'>No Result</option>
                        <option value='Duplicate'>Duplicate</option>
                    </select>
                </div>
            </div>

            <div class="row g-3 align-items-center justify-content-md-center">
                <div class="col">
                    <label for="voice_staff_disposition" class="col-form-label">Voice Staff Disposition:</label>
                </div>
                <div class="col">
                    <select class='form-control form-control-sm' id="voice_staff_disposition"  name='voice_staff_disposition'>
                        <option value=''>select Web Disposition</option>
                        <option value='Verified'>Verified</option>
                        <option value='Acquired'>Acquired</option>
                        <option value='Staff Left'>Staff Left</option>
                        <option value='Replaced'>Replaced</option>
                        <option value='Not Verified'>Not Verified</option>
                        <option value='Added'>Added</option>
                        <option value='Duplicate'>Duplicate</option>
                        <option value='Operator Refused'>Operator Refused</option>
                        <option value='Operator Unaware'>Operator Unaware</option>
                        <option value='IVR'>IVR</option>
                        <option value='Voicemail'>Voicemail</option>
                        <option value='DND'>DND</option>
                        <option value='Callback'>Callback</option>
                    </select>
                </div>
            </div>

            <div class="row g-3 align-items-center justify-content-md-center">
                <div class="col">
                    <label for="staff_interest_area" class="col-form-label">Interest Area:</label>
                </div>
                <div class="col">
                    <input type="text" value="" title="" id="staff_interest_area"  name='staff_interest_area' class="form-control form-control-sm">
                </div>
            </div>

            

            <div class="row g-3 align-items-center justify-content-md-center">
                <div class="col">
                    <label for="staff_linkedin_count" class="col-form-label">Linkedin Connections Count:</label>
                </div>
                <div class="col">
                    <input type="number" value="" title="" id="staff_linkedin_count"  name='staff_linkedin_count' class="form-control form-control-sm">
                </div>
            </div>

            <div class="row g-3 align-items-center justify-content-md-center">
                <div class="col">
                    <label for="staff_note" class="col-form-label">Staff Note:</label>
                </div>
                <div class="col mb-1">
                    <textarea title="" id="staff_note"  name='staff_note' class="form-control form-control-sm"></textarea>
                </div>
            </div>

            <div class="row g-3 align-items-center justify-content-md-center">
                <div class="col">
                    <label for="staff_remark" class="col-form-label">Staff Remark:</label>
                </div>
                <div class="col">
                    <textarea title="" id="staff_remark"  name='staff_remark' class="form-control form-control-sm"></textarea>
                </div>
            </div>

            
            <br><br><br>
            

        </div>





        <div class="col">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button style='font-size:12px' class="nav-link active" id="company-tab" data-bs-toggle="tab" data-bs-target="#company" type="button" role="tab" aria-controls="company" aria-selected="true">The Savola Group (23)</button>
            </li>
            <li class="nav-item" role="presentation">
                <button style='font-size:12px' class="nav-link" id="project-tab" data-bs-toggle="tab" data-bs-target="#project" type="button" role="tab" aria-controls="project" aria-selected="false">BTB-02-T (2)</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="company" role="tabpanel" aria-labelledby="company-tab">
            <div class='table-responsive' style='height:333px;font-size:12px'>
                <table class="table table-hover table-bordered table-sm p-0 m-0" width="100%" cellspacing="0" id="company_table">
                    <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Co. Disposition</th>
                    </tr>
                    <tr class="">
                        <td><a href="https://192.168.0.55/dbp/allinfo/index?project_name=BTB-02-T&records_relation=r12&staff_id=58&company_id=58&project_id=58&staff_name=Abdulrahman+Basharahil"><i class="fas fa-eye"></i></a></td>
                        <td>Abdulrahman</td><td>Basharahil</td>
                        <td>Name Corrected</td>
                    </tr>
                    <tr class="">
                        <td><a href="https://192.168.0.55/dbp/allinfo/index?project_name=BTB-02-T&records_relation=r12&staff_id=59&company_id=59&project_id=59&staff_name=Ahmed+Omran"><i class="fas fa-eye"></i></a></td><td>Ahmed</td><td>Omran</td><td>Name Corrected</td></tr><tr class=""><td><a href="https://192.168.0.55/dbp/allinfo/index?project_name=BTB-02-T&records_relation=r12&staff_id=60&company_id=60&project_id=60&staff_name=Ayman+Basalamah"><i class="fas fa-eye"></i></a></td><td>Ayman</td><td>Basalamah</td><td>Name Corrected</td></tr><tr class="bg-warning"><td><a href="https://192.168.0.55/dbp/allinfo/index?project_name=BTB-02-T&records_relation=r12&staff_id=61&company_id=61&project_id=61&staff_name=Mohamed+Abdelmohdi"><i class="fas fa-eye"></i></a></td><td>Mohamed</td><td>Abdelmohdi</td><td>Name Corrected</td></tr><tr class=""><td><a href="https://192.168.0.55/dbp/allinfo/index?project_name=BTB-02-T&records_relation=r12&staff_id=62&company_id=62&project_id=62&staff_name=Omar+Alattas"><i class="fas fa-eye"></i></a></td><td>Omar</td><td>Alattas</td><td>Name Corrected</td></tr><tr class=""><td><a href="https://192.168.0.55/dbp/allinfo/index?project_name=BTB-02-T&records_relation=r12&staff_id=63&company_id=63&project_id=63&staff_name=Taher+Elashry"><i class="fas fa-eye"></i></a></td><td>Taher</td><td>Elashry</td><td>Name Corrected</td></tr><tr class=""><td><a href="https://192.168.0.55/dbp/allinfo/index?project_name=BTB-02-T&records_relation=r12&staff_id=64&company_id=64&project_id=64&staff_name=Abdulatif+Bahdlag"><i class="fas fa-eye"></i></a></td><td>Abdulatif</td><td>Bahdlag</td><td>Name Corrected</td></tr><tr class=""><td><a href="https://192.168.0.55/dbp/allinfo/index?project_name=BTB-02-T&records_relation=r12&staff_id=65&company_id=65&project_id=65&staff_name=Abdulrazzak+Kablan+Abdullah"><i class="fas fa-eye"></i></a></td><td>Abdulrazzak Kablan</td><td>Abdullah</td><td>Name Corrected</td></tr><tr class=""><td><a href="https://192.168.0.55/dbp/allinfo/index?project_name=BTB-02-T&records_relation=r12&staff_id=66&company_id=66&project_id=66&staff_name=Ahmed+El+Shime"><i class="fas fa-eye"></i></a></td><td>Ahmed El</td><td>Shime</td><td>Name Corrected</td></tr><tr class=""><td><a href="https://192.168.0.55/dbp/allinfo/index?project_name=BTB-02-T&records_relation=r12&staff_id=67&company_id=67&project_id=67&staff_name=Ahmed+Hani"><i class="fas fa-eye"></i></a></td><td>Ahmed</td><td>Hani</td><td>Name Corrected</td></tr><tr class=""><td><a href="https://192.168.0.55/dbp/allinfo/index?project_name=BTB-02-T&records_relation=r12&staff_id=68&company_id=68&project_id=68&staff_name=Amr+Almadani"><i class="fas fa-eye"></i></a></td><td>Amr</td><td>Almadani</td><td>Name Corrected</td></tr><tr class=""><td><a href="https://192.168.0.55/dbp/allinfo/index?project_name=BTB-02-T&records_relation=r12&staff_id=69&company_id=69&project_id=69&staff_name=Dania+Al-saygh"><i class="fas fa-eye"></i></a></td><td>Dania</td><td>Al-saygh</td><td>Name Corrected</td></tr><tr class=""><td><a href="https://192.168.0.55/dbp/allinfo/index?project_name=BTB-02-T&records_relation=r12&staff_id=70&company_id=70&project_id=70&staff_name=Ikram+El+Alami"><i class="fas fa-eye"></i></a></td><td>Ikram</td><td>El Alami</td><td>Name Corrected</td></tr><tr class=""><td><a href="https://192.168.0.55/dbp/allinfo/index?project_name=BTB-02-T&records_relation=r12&staff_id=71&company_id=71&project_id=71&staff_name=Magdi+Habib"><i class="fas fa-eye"></i></a></td><td>Magdi</td><td>Habib</td><td>Name Corrected</td></tr><tr class=""><td><a href="https://192.168.0.55/dbp/allinfo/index?project_name=BTB-02-T&records_relation=r12&staff_id=72&company_id=72&project_id=72&staff_name=Majed+Hussein"><i class="fas fa-eye"></i></a></td><td>Majed</td><td>Hussein</td><td>Name Corrected</td></tr><tr class=""><td><a href="https://192.168.0.55/dbp/allinfo/index?project_name=BTB-02-T&records_relation=r12&staff_id=73&company_id=73&project_id=73&staff_name=Majid+Khan"><i class="fas fa-eye"></i></a></td><td>Majid</td><td>Khan</td><td>Name Corrected</td></tr><tr class=""><td><a href="https://192.168.0.55/dbp/allinfo/index?project_name=BTB-02-T&records_relation=r12&staff_id=74&company_id=74&project_id=74&staff_name=Marwa+El+Dahrawy"><i class="fas fa-eye"></i></a></td><td>Marwa</td><td>El Dahrawy</td><td>Name Corrected</td></tr><tr class=""><td><a href="https://192.168.0.55/dbp/allinfo/index?project_name=BTB-02-T&records_relation=r12&staff_id=75&company_id=75&project_id=75&staff_name=Mira+Mahdy"><i class="fas fa-eye"></i></a></td><td>Mira</td><td>Mahdy</td><td>Name Corrected</td></tr><tr class=""><td><a href="https://192.168.0.55/dbp/allinfo/index?project_name=BTB-02-T&records_relation=r12&staff_id=76&company_id=76&project_id=76&staff_name=Nadia+Amenouche"><i class="fas fa-eye"></i></a></td><td>Nadia</td><td>Amenouche</td><td>Name Corrected</td></tr><tr class=""><td><a href="https://192.168.0.55/dbp/allinfo/index?project_name=BTB-02-T&records_relation=r12&staff_id=77&company_id=77&project_id=77&staff_name=Nouh+Bettache"><i class="fas fa-eye"></i></a></td><td>Nouh</td><td>Bettache</td><td>Name Corrected</td></tr><tr class=""><td><a href="https://192.168.0.55/dbp/allinfo/index?project_name=BTB-02-T&records_relation=r12&staff_id=78&company_id=78&project_id=78&staff_name=Omar+Abouzeid"><i class="fas fa-eye"></i></a></td><td>Omar</td><td>Abouzeid</td><td>Name Corrected</td></tr><tr class=""><td><a href="https://192.168.0.55/dbp/allinfo/index?project_name=BTB-02-T&records_relation=r12&staff_id=79&company_id=79&project_id=79&staff_name=Omar+Awad"><i class="fas fa-eye"></i></a></td><td>Omar</td><td>Awad</td><td>Name Corrected</td></tr><tr class=""><td><a href="https://192.168.0.55/dbp/allinfo/index?project_name=BTB-02-T&records_relation=r12&staff_id=80&company_id=80&project_id=80&staff_name=Zeina+Thabet"><i class="fas fa-eye"></i></a></td><td>Zeina</td><td>Thabet</td><td>Name Corrected</td></tr></table></div>            </div>
            <div class="tab-pane fade" id="project" role="tabpanel" aria-labelledby="project-tab">
            <div class='table-responsive' style='height:333px;font-size:12px'><table class="table table-hover table-bordered table-sm p-0 m-0" width="100%" cellspacing="0" id="project_table"><tr><th>#</th><th>Company Name</th><th>Co. Disposition</th></tr><tr class=""><td><a href="https://192.168.0.55/dbp/allinfo/index?project_name=BTB-02-T&records_relation=r12&staff_id=56&company_id=56&project_id=56&staff_name=Shinny+Simmons+"><i class="fas fa-eye"></i></a></td><td>Saudi German Hospitals Group UAE</td><td></td></tr><tr class="bg-warning"><td><a href="https://192.168.0.55/dbp/allinfo/index?project_name=BTB-02-T&records_relation=r12&staff_id=58&company_id=58&project_id=58&staff_name=Abdulrahman+Basharahil"><i class="fas fa-eye"></i></a></td><td>The Savola Group</td><td>Name Corrected</td></tr></table></div>            </div>
        </div>
        </div>
    </div>




</main>

<script>
$(document).ready(function() {

    $('.row1').css({
        height: ($('body').height() - 11) / 2 //divide the body into to 2 rows
    });

    // populate href of first,prev,next & last buttons...
    $('#first').attr('href', $('table#company_table').first().find('a').attr('href'));
    $('#prev').attr('href', $('table#company_table tr.bg-warning').prev().find('a').attr('href'));
    $('#next').attr('href', $('table#company_table tr.bg-warning').next().find('a').attr('href'));
    $('#last').attr('href', $('table#company_table tr').last().find('a').attr('href'));

    $('#voice_disposition').change(function(){
        var disposition = $(this).val();
        if(disposition == 'Incomplete') {$('.incomplete_disposition').fadeIn(1000);}
        else {$('.incomplete_disposition').fadeOut(1000);}
    });

    $('ul.revenue_currency li').click(function(){
        $('#revenue_currency').text($(this).text());
    });

});
</script>






<script src="<?php echo base_url();?>public/js/bootstrap.bundle.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" crossorigin="anonymous"></script>
</body>
</html>