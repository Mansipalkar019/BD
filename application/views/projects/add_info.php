<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="BDS DATABASE PROJECT">
      <meta name="author" content="Mohammed Sufian Shaikh">
      <link href="https://bdsserv.com/assets/icon/fv.png" rel="icon">
      <title>All Informations | BD-CRM</title>
      <link href="<?php echo base_url();?>public/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
      <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
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
         .container-fluid { padding: 20px; margin: 0px; } /*padding-top: 55px;*/
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
               <!-- check input access for company received -->
               <?php        
                  if(in_array('company_received',$project_info)) { ?>
               <div class="row g-3 align-items-center justify-content-md-center">
                  <div class="col">
                     <label for="company_received" class="col-form-label">Co. Name Recd:</label>
                  </div>
                  <div class="col">
                     <input type="text" value="<?=  (!empty($allInfo[0]['received_company_name'])) ?  $allInfo[0]['received_company_name'] : ''  ?>" title="" id="company_received"  name='company_received' class="form-control form-control-sm" disabled>
                  </div>
               </div>
               <?php } ?>
               <!-- check input access for company name -->
               <?php if(in_array('company_name',$project_info)) { ?>
               <div class="row g-3 align-items-center justify-content-md-center">
                  <div class="col">
                     <label for="company_name" class="col-form-label">Co. Name:</label>
                  </div>
                  <div class="col">
                     <input type="text" value="<?=  (!empty($allInfo[0]['company_name'])) ?  $allInfo[0]['company_name'] : ''  ?>" title="" id="company_name"  name='company_name' class="form-control form-control-sm">
                  </div>
               </div>
               <?php } ?>
               <div class="row g-3 align-items-center justify-content-md-center">
                  <!-- check input access for address_1 -->
                  <?php if(in_array('address_1',$project_info)){ ?>
                  <div class="col">
                     <label for="address_1" class="col-form-label">Address:</label>
                     <input type="text" value="<?=  (!empty($allInfo[0]['address1'])) ?  $allInfo[0]['address1'] : ''  ?>" title="" id="address_1"  name='address_1' class="form-control form-control-sm">
                  </div>
                  <?php } ?>
                  <!-- check input access for address_2 -->
                  <?php if(in_array('address_2',$project_info)){ ?>
                  <div class="col">
                     <label for="address_2" class="col-form-label">Address 2:</label>
                     <input type="text" value="<?=  (!empty($allInfo[0]['address2'])) ?  $allInfo[0]['address2'] : ''  ?>" title="" id="address_2"  name='address_2' class="form-control form-control-sm">
                  </div>
                  <?php } ?>
                  <!-- check input access for address_3 -->
                  <?php if(in_array('address_3',$project_info)){ ?>
                  <div class="col">
                     <label for="address_3" class="col-form-label">Address 3:</label>
                     <input type="text" value="<?=  (!empty($allInfo[0]['address3'])) ?  $allInfo[0]['address3'] : ''  ?>" title="" id="address_3"  name='address_3' class="form-control form-control-sm">
                  </div>
                  <?php } ?>
               </div>
               <?php 
                  $div_count=div_access($project_info,array('city_name','postal_code','state_name'));
                  $access = ($div_count < 1) ? "style='display:none;'" :  '' ; 
                  ?>
               <div class="row g-3 align-items-center justify-content-md-center" <?= $access; ?>>
                  <!-- check input access for city -->
                  <?php if(in_array('city_name',$project_info)){ ?>
                  <div class="col">
                     <label for="city_name" class="col-form-label">City:</label>
                     <input type="text" value="<?=  (!empty($allInfo[0]['city'])) ?  $allInfo[0]['city'] : ''  ?>" title="" id="city_name"  name='city_name' class="form-control form-control-sm">
                  </div>
                  <?php } ?>
                  <!-- check input access for pincode -->
                  <?php if(in_array('postal_code',$project_info)){ ?>
                  <div class="col">
                     <label for="postal_code" class="col-form-label">Postal Code:</label>
                     <input type="text" value="<?=  (!empty($allInfo[0]['postal_code'])) ?  $allInfo[0]['postal_code'] : ''  ?>" title="" id="postal_code"  name='postal_code' class="form-control form-control-sm">
                  </div>
                  <?php } ?>
                  <!-- check input access for state/country -->
                  <?php if(in_array('state_name',$project_info)){ ?>
                  <div class="col">
                     <label for="state_name" class="col-form-label">State/County:</label>
                     <input type="text" value="<?=  (!empty($allInfo[0]['state_country'])) ?  $allInfo[0]['state_country'] : ''  ?>" title="" id="state_name"  name='state_name' class="form-control form-control-sm">
                  </div>
                  <?php } ?>
               </div>
               <?php 
                  $div_count=div_access($project_info,array('country','region_name','address_source_url'));
                  $access1 = ($div_count < 1) ? "style='display:none;'" :  '' ; 
                  ?>
               <div class="row g-3 align-items-center justify-content-md-center" <?= $access1; ?>>
                  <!-- check input access for country -->
                  <?php if(in_array('country',$project_info)){ ?>
                  <div class="col">
                     <label for="country" class="col-form-label">Country:</label>
                     <select class='form-control form-control-sm' id="country"  name='country'>
                        <option value=''>Select Country</option>
                        <?php 
                           foreach ($country as $key => $val) { ?>
                        <option value='<?= $val['id']; ?>' <?php if(strtolower($allInfo[0]['country'])==strtolower($val['name'])){?>selected<?php } ?>><?= $val['name']; ?></option>
                        <?php }
                           ?>
                     </select>
                  </div>
                  <?php } ?>
                  <!-- check input access for region -->
                  <?php if(in_array('region_name',$project_info)){ ?>
                  <div class="col">
                     <label for="region_name" class="col-form-label">Region:</label>
                     <input type="text" value="<?=  (!empty($allInfo[0]['region'])) ?  $allInfo[0]['region'] : ''  ?>" title="" id="region_name"  name='region_name' class="form-control form-control-sm">
                  </div>
                  <?php } ?>
                  <!-- check input access for address_url -->
                  <?php if(in_array('address_source_url',$project_info)){ ?>
                  <div class="col">
                     <label for="address_source_url" class="col-form-label" style="font-size: 0.7rem;">Address Source URL:</label>
                     <input type="text" value="<?=  (!empty($allInfo[0]['address_souce_url'])) ?  $allInfo[0]['address_souce_url'] : ''  ?>" title="" id="address_source_url"  name='address_source_url' class="form-control form-control-sm">
                  </div>
                  <?php } ?>
               </div>
               <!-- check input access for ca1,ca2,ca3,ca4,ca5 -->
               <?php 
                  $div_count=div_access($project_info,array('ca1','ca2','ca3','ca4','ca5'));
                  $access2 = ($div_count < 1) ? "style='display:none;'" :  '' ; 
                  ?>
               <div class="row g-3 align-items-center justify-content-md-center" <?= $access2; ?>>
                  <?php if(in_array('ca1',$project_info)){ ?>
                  <div class="col">
                     <label for="ca1" class="col-form-label">CA1:</label>
                     <input type="text" value="<?=  (!empty($allInfo[0]['ca1'])) ?  $allInfo[0]['ca1'] : ''  ?>" title="" id="ca1"  name='ca1' class="form-control form-control-sm">
                  </div>
                  <?php } ?>
                  <?php if(in_array('ca2',$project_info)){ ?>
                  <div class="col">
                     <label for="ca2" class="col-form-label">CA2:</label>
                     <input type="text" value="<?=  (!empty($allInfo[0]['ca2'])) ?  $allInfo[0]['ca2'] : ''  ?>" title="" id="ca2"  name='ca2' class="form-control form-control-sm">
                  </div>
                  <?php } ?>
                  <?php if(in_array('ca3',$project_info)){ ?>
                  <div class="col">
                     <label for="ca3" class="col-form-label">CA3:</label>
                     <input type="text" value="<?=  (!empty($allInfo[0]['ca3'])) ?  $allInfo[0]['ca3'] : ''  ?>" title="" id="ca3"  name='ca3' class="form-control form-control-sm">
                  </div>
                  <?php } ?>
                  <?php if(in_array('ca4',$project_info)){ ?>
                  <div class="col">
                     <label for="ca4" class="col-form-label">CA4:</label>
                     <input type="text" value="<?=  (!empty($allInfo[0]['ca4'])) ?  $allInfo[0]['ca4'] : ''  ?>" title="" id="ca4"  name='ca4' class="form-control form-control-sm">
                  </div>
                  <?php } ?>
                  <?php if(in_array('ca5',$project_info)){ ?>
                  <div class="col">
                     <label for="ca5" class="col-form-label">CA5:</label>
                     <input type="text" value="<?=  (!empty($allInfo[0]['ca5'])) ?  $allInfo[0]['ca5'] : ''  ?>" title="" id="ca5"  name='ca5' class="form-control form-control-sm">
                  </div>
                  <?php } ?>
               </div>
            </div>
            <div class="col">
               <div class="alert alert-warning text-center p-1" role="alert">(BTB-02-T) / (NMD) / (<a data-bs-toggle="modal" data-bs-target="#briefDetails" href="#" class="text-underline">CO. BRIEF</a>)</div>
               <div class="modal fade" id="briefDetails" tabindex="-1" aria-labelledby="briefDetailsLabel" aria-hidden="true">
                  <div class="modal-dialog">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h5 class="modal-title" id="briefDetailsLabel">Project - Company Brief</h5>
                        </div>
                        <div class="modal-body text-center"><b><?=  (!empty($allInfo[0]['project_breif'])) ?  $allInfo[0]['project_breif'] : ''  ?></b></div>
                        <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button></div>
                     </div>
                  </div>
               </div>
               <!-- check input access for company_disposition -->
               <?php 
                  $div_count=div_access($project_info,array('company_disposition'));
                  $access3 = ($div_count < 1) ? "style='display:none;'" :  '' ; 
                  ?>
               <div class="row g-3 align-items-center justify-content-md-center" <?= $access3; ?>>
                  <?php if(in_array('company_disposition',$project_info)){ ?>
                  <div class="col">
                     <label for="company_disposition" class="col-form-label">Co. Disposition:</label>
                  </div>
                  <div class="col">
                     <select class='form-control form-control-sm' id="company_disposition"  name='company_disposition'>
                        <option value=''>Select Co. Disposition</option>
                        <?php 
                           foreach ($compDispo as $key => $val) { ?>
                        <option value='<?= $val['id']; ?>' <?php if($allInfo[0]['company_dispostion']==$val['company_dispostion']){?>selected<?php } ?> ><?= $val['company_dispostion']; ?></option>
                        <?php }
                           ?>
                     </select>
                  </div>
                  <?php } ?>
               </div>
               <!-- check input access for company_web_dispositon -->
               <?php 
                  $div_count=div_access($project_info,array('company_web_dispositon'));
                  $access4 = ($div_count < 1) ? "style='display:none;'" :  '' ; 
                  ?>
               <div class="row g-3 align-items-center justify-content-md-center" <?= $access4; ?>>
                  <?php if(in_array('company_web_dispositon',$project_info)){ ?>
                  <div class="col">
                     <label for="company_web_dispositon" class="col-form-label">Co. Web Disposition:</label>
                  </div>
                  <div class="col">
                     <select class='form-control form-control-sm' id="company_web_dispositon"  name='company_web_dispositon'>
                        <option value=''>Select Web Disposition</option>
                        <?php 
                           foreach ($webDispo as $key => $val) { ?>
                        <option value='<?= $val['id']; ?>' <?php if($allInfo[0]['web_disposition']==$val['web_disposition_name']){?>selected<?php } ?>><?= $val['web_disposition_name']; ?></option>
                        <?php }
                           ?>
                     </select>
                  </div>
                  <?php } ?>
               </div>
               <!-- check input access for company_voice_disposition -->
               <?php 
                  $div_count=div_access($project_info,array('company_voice_disposition'));
                  $access5 = ($div_count < 1) ? "style='display:none;'" :  '' ; 
                  ?>
               <div class="row g-3 align-items-center justify-content-md-center" <?= $access5; ?>>
                  <?php if(in_array('company_voice_disposition',$project_info)){ ?>
                  <div class="col">
                     <label for="company_voice_disposition" class="col-form-label">Co. Voice Disposition:</label>
                  </div>
                  <div class="col">
                     <select class='form-control form-control-sm' id="company_voice_disposition"  name='company_voice_disposition'>
                        <option value=''>Select Voice Disposition</option>
                        <?php 
                           foreach ($VoiceDispo as $key => $val) { ?>
                        <option value='<?= $val['id']; ?>' <?php if($allInfo[0]['voice_disposition']==$val['caller_disposition']){?>selected<?php } ?>><?= $val['caller_disposition']; ?></option>
                        <?php }
                           ?>
                     </select>
                  </div>
                  <?php } ?>
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
                           <option value='Language Issue'>Language Issue</option>
                           <option value='RNU'>RNU</option>
                        </select>
                     </div>
                  </div>
               </div>
               <!-- check input access for company_voice_disposition -->
               <?php 
                  $div_count=div_access($project_info,array('company_genaral_notes'));
                  $access6 = ($div_count < 1) ? "style='display:none;'" :  '' ; 
                  ?>
               <div class="row g-3 align-items-center justify-content-md-center" <?= $access6; ?>>
                  <?php if(in_array('company_genaral_notes',$project_info)){ ?>
                  <div class="col">
                     <label for="company_genaral_notes" class="col-form-label">Co. General Notes:</label>
                  </div>
                  <div class="col">
                     <input type="text" value="<?=  (!empty($allInfo[0]['genral_notes'])) ?  $allInfo[0]['genral_notes'] : ''  ?>" title="" id="company_genaral_notes"  name='company_genaral_notes' class="form-control form-control-sm">
                  </div>
                  <?php } ?>
               </div>
               <!-- check input access for company_voice_disposition -->
               <?php 
                  $div_count=div_access($project_info,array('company_remark'));
                  $access7 = ($div_count < 1) ? "style='display:none;'" :  '' ; 
                  ?>
               <div class="row g-3 align-items-center justify-content-md-center" <?= $access7; ?>>
                  <?php if(in_array('company_remark',$project_info)){ ?>
                  <div class="col">
                     <label for="company_remark" class="col-form-label">Co. Remark:</label>
                  </div>
                  <div class="col">
                     <textarea title="" id="company_remark"  name='company_remark' class="form-control form-control-sm"><?=  (!empty($allInfo[0]['remarks'])) ?  $allInfo[0]['remarks'] : ''  ?></textarea>
                  </div>
                  <?php } ?>
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
               <!-- check input access for tel_number,country_code -->
               <?php 
                  $div_count=div_access($project_info,array('tel_number','country_code'));
                  $access8 = ($div_count < 1) ? "style='display:none;'" :  '' ; 
                  ?>
               <div class="row g-3 align-items-center justify-content-md-center" <?= $access8; ?>>
                  <?php if(in_array('country_code',$project_info)){ ?>
                  <div class="col">
                     <label for="country_code" class="col-form-label">Country Code:</label>
                     <input type="number" value="<?=  (!empty($allInfo[0]['country_code'])) ?  $allInfo[0]['country_code'] : ''  ?>" title="" id="country_code"  name='country_code' class="form-control form-control-sm" readonly>
                  </div>
                  <?php } ?>
                  <!-- <div class="col">
                     <label for="area_code" class="col-form-label">Area Code:</label>
                     <input type="number" value="" title="" id="area_code"  name='area_code' class="form-control form-control-sm" size="6">
                     </div> -->
                  <?php if(in_array('tel_number',$project_info)){ ?>
                  <div class="col">
                     <label for="tel_number" class="col-form-label">Telephone Number:</label>
                     <input type="number" value="<?=  (!empty($allInfo[0]['tel_number'])) ?  $allInfo[0]['tel_number'] : ''  ?>" title="2 2403 3856" id="tel_number"  name='tel_number' class="form-control form-control-sm">
                  </div>
                  <?php } ?>
               </div>
               <!-- check input access for alternate_number,tel_number -->
               <?php 
                  $div_count=div_access($project_info,array('alternate_number','tel_number'));
                  $access9 = ($div_count < 1) ? "style='display:none;'" :  '' ; 
                  ?>
               <div class="row g-3 align-items-center justify-content-md-center" <?= $access9; ?>>
                  <?php if(in_array('alternate_number',$project_info)){ ?>
                  <div class="col">
                     <label for="alternate_number" class="col-form-label">Alternate Number:</label>
                     <input type="number" value="<?=  (!empty($allInfo[0]['alternate_number'])) ?  $allInfo[0]['alternate_number'] : ''  ?>" title="" id="alternate_number"  name='alternate_number' class="form-control form-control-sm">
                  </div>
                  <?php } ?>
                  <!-- <div class="col">
                     <label for="fax_number" class="col-form-label">Fax Number:</label>
                     <input type="number" value="" title="" id="fax_number"  name='fax_number' class="form-control form-control-sm">
                     </div> -->
                  <?php if(in_array('website_url',$project_info)){ ?>
                  <div class="col">
                     <label for="website_url" class="col-form-label">Website URL:</label>
                     <input type="text" value="<?=  (!empty($allInfo[0]['website_url'])) ?  $allInfo[0]['website_url'] : ''  ?>" title="" id="website_url"  name='website_url' class="form-control form-control-sm">
                  </div>
                  <?php } ?>
                  <!-- check input access for email_address,no_of_employees -->
                  <?php 
                     $div_count=div_access($project_info,array('email_address','no_of_employees'));
                     $access10 = ($div_count < 1) ? "style='display:none;'" :  '' ; 
                     ?>
                  <!-- <div class="row g-3 align-items-center justify-content-md-center" <?= $access10; ?>>
                     <?php if(in_array('email_address',$project_info)){ ?>
                         <div class="col">
                             <label for="email_address" class="col-form-label">Email Address:</label>
                             <input type="email" value="<?=  (!empty($allInfo[0]['ca5'])) ?  $allInfo[0]['ca5'] : ''  ?>" title="" id="email_address"  name='email_address' class="form-control form-control-sm">
                         </div>
                     <?php } ?> -->
                  <?php if(in_array('no_of_employees',$project_info)){ ?>
                  <div class="col">
                     <label for="no_of_employees" class="col-form-label">No. of Employees:</label>
                     <input type="number" value="<?=  (!empty($allInfo[0]['no_of_emp'])) ?  $allInfo[0]['no_of_emp'] : ''  ?>" title="" id="no_of_employees"  name='no_of_employees' class="form-control form-control-sm">
                  </div>
                  <?php } ?>
               </div>
               <!-- <div class="row g-3 align-items-center justify-content-md-center">
                  <div class="col">
                      <label for="sic_code" class="col-form-label">SIC Code:</label>
                      <input type="text" value="" title="" id="sic_code"  name='sic_code' class="form-control form-control-sm">
                  </div>
                  <div class="col">
                      <label for="sic_description" class="col-form-label">SIC Description:</label>
                      <input type="text" value="" title="" id="sic_description"  name='sic_description' class="form-control form-control-sm">
                  </div>
                  </div> -->
               <!-- check input access for industry,revenue -->
               <?php 
                  $div_count=div_access($project_info,array('industry','revenue'));
                  $access11 = ($div_count < 1) ? "style='display:none;'" :  '' ; 
                  ?>
               <div class="row g-3 align-items-center justify-content-md-center" <?= $access11; ?>>
                  <?php if(in_array('industry',$project_info)){ ?>
                  <div class="col">
                     <label for="industry" class="col-form-label">Industry:</label>
                     <input type="text" value="<?=  (!empty($allInfo[0]['industry'])) ?  $allInfo[0]['industry'] : ''  ?>" title="" id="industry"  name='industry' class="form-control form-control-sm">
                  </div>
                  <?php } ?>
                  <?php if(in_array('revenue',$project_info)){ ?>
                  <div class="col">
                     <label for="revenue" class="col-form-label">Revenue:</label>
                     <div class="input-group">
                        <input type="number" value="<?=  (!empty($allInfo[0]['revenue'])) ?  $allInfo[0]['revenue'] : ''  ?>" title="" id="revenue"  name='revenue' class="form-control form-control-sm">
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
                  <?php } ?>
               </div>
            </div>
         </div>
         <div class="row row1">
            <div class="col">
               <!-- check input access for first_name,last_name -->
               <?php 
                  $div_count=div_access($project_info,array('first_name','last_name'));
                  $access12 = ($div_count < 1) ? "style='display:none;'" :  '' ; 
                  ?>
               <div class="row g-3 align-items-center justify-content-md-center" <?= $access12; ?>>
                  <div class="col">
                     <label for="title" class="col-form-label">Title:</label>
                         <select class='form-control form-control-sm' id="title"  name='title'>
                            <option value=''>select a title</option>
                            <?php 
                            foreach ($name_prefix as $key => $val) { ?>
                            <option value='<?= $val['id']; ?>' <?php if($allInfo[0]['suffix'] == $val['prefix']){?>selected<?php } ?>><?= $val['prefix']; ?></option>
                            <?php }
                            ?>
                         </select>
                     </div>
                  <?php if(in_array('first_name',$project_info)){ ?>
                  <div class="col">
                     <label for="first_name" class="col-form-label">First Name:</label>
                     <input type="text" value="<?=  (!empty($allInfo[0]['first_name'])) ?  $allInfo[0]['first_name'] : ''  ?>" title="" id="first_name"  name='first_name' class="form-control form-control-sm">
                  </div>
                  <?php } ?>
                  <?php if(in_array('last_name',$project_info)){ ?>
                  <div class="col">
                     <label for="last_name" class="col-form-label">Last Name:</label>
                     <input type="text" value="<?=  (!empty($allInfo[0]['last_name'])) ?  $allInfo[0]['last_name'] : ''  ?>"  id="last_name"  name='last_name' class="form-control form-control-sm">
                  </div>
                  <?php } ?>
               </div>
               <!-- check input access for job_title -->
               <?php 
                  $div_count=div_access($project_info,array('job_title'));
                  $access13 = ($div_count < 1) ? "style='display:none;'" :  '' ; 
                  ?>
               <div class="row g-3 align-items-center justify-content-md-center"  <?= $access13; ?>>
                  <?php if(in_array('job_title',$project_info)){ ?>
                  <div class="col">
                     <label for="job_title" class="col-form-label">Job Title:</label>
                  </div>
                  <div class="col">
                     <input type="text" value="<?=  (!empty($allInfo[0]['provided_job_title'])) ?  $allInfo[0]['provided_job_title'] : ''  ?>" title="" id="job_title"  name='job_title' class="form-control form-control-sm">
                  </div>
                  <?php } ?>
               </div>
               <!-- check input access for staff_job_function -->
               <?php 
                  $div_count=div_access($project_info,array('staff_job_function'));
                  $access14 = ($div_count < 1) ? "style='display:none;'" :  '' ; 
                  ?>
               <div class="row g-3 align-items-center justify-content-md-center" <?= $access14; ?>>
                  <?php if(in_array('staff_job_function',$project_info)){ ?>
                  <div class="col">
                     <label for="staff_job_function" class="col-form-label">Job Function:</label>
                  </div>
                  <div class="col">
                     <input type="text" value="<?=  (!empty($allInfo[0]['staff_job_function'])) ?  $allInfo[0]['staff_job_function'] : ''  ?>" title="" id="staff_job_function"  name='staff_job_function' class="form-control form-control-sm">
                  </div>
                  <?php } ?>
               </div>
               <!-- check input access for staff_job_function -->
               <?php 
                  $div_count=div_access($project_info,array('staff_email'));
                  $access15 = ($div_count < 1) ? "style='display:none;'" :  '' ; 
                  ?>
               <div class="row g-3 align-items-center justify-content-md-center" <?= $access15; ?>>
                  <?php if(in_array('staff_email',$project_info)){ ?>
                  <div class="col">
                     <label for="staff_email" class="col-form-label">Staff Email:</label>
                  </div>
                  <div class="col">
                     <div class="input-group">
                        <input type="email" value="<?=  (!empty($allInfo[0]['staff_email'])) ?  $allInfo[0]['staff_email'] : ''  ?>" title="" id="staff_email"  name='staff_email' class="form-control form-control-sm">
                        <div class="input-group-text">
                           <input class="form-check-input mt-0" type="checkbox" value="" id="staff_email_verified" >
                        </div>
                     </div>
                  </div>
                  <?php } ?>
               </div>
               <!-- check input access for staff_department -->
               <?php 
                  $div_count=div_access($project_info,array('staff_department'));
                  $access16 = ($div_count < 1) ? "style='display:none;'" :  '' ; 
                  ?>
               <div class="row g-3 align-items-center justify-content-md-center" <?= $access16; ?>>
                  <?php if(in_array('staff_department',$project_info)){ ?>
                  <div class="col">
                     <label for="staff_department" class="col-form-label">Staff Department:</label>
                  </div>
                  <div class="col">
                     <input type="text" value="<?=  (!empty($allInfo[0]['staff_department'])) ?  $allInfo[0]['staff_department'] : ''  ?>" title="" id="staff_department"  name='staff_department' class="form-control form-control-sm">
                  </div>
                  <?php } ?>
               </div>
               <!-- check input access for staff_department -->
               <?php 
                  $div_count=div_access($project_info,array('staff_url'));
                  $access17 = ($div_count < 1) ? "style='display:none;'" :  '' ; 
                  ?>
               <div class="row g-3 align-items-center justify-content-md-center" <?= $access17; ?>>
                  <?php if(in_array('staff_url',$project_info)){ ?>
                  <div class="col">
                     <label for="staff_url" class="col-form-label">Staff Source URL:</label>
                  </div>
                  <div class="col">
                     <input type="text" value="<?=  (!empty($allInfo[0]['staff_url'])) ?  $allInfo[0]['staff_url'] : ''  ?>" title="" id="staff_url"  name='staff_url' class="form-control form-control-sm">
                  </div>
                  <?php } ?>
               </div>
               <!-- check input access for staff_department -->
               <?php 
                  $div_count=div_access($project_info,array('assumed_email'));
                  $access18 = ($div_count < 1) ? "style='display:none;'" :  '' ; 
                  ?>
               <div class="row g-3 align-items-center justify-content-md-center" <?= $access18; ?>>
                  <?php if(in_array('assumed_email',$project_info)){ ?>
                  <div class="col">
                     <label for="assumed_email" class="col-form-label">Assumed Email:</label>
                  </div>
                  <div class="col">
                     <input type="email" value="<?=  (!empty($allInfo[0]['assumed_email'])) ?  $allInfo[0]['assumed_email'] : ''  ?>" title="" id="assumed_email"  name='assumed_email' class="form-control form-control-sm">
                  </div>
                  <?php } ?>
               </div>
               <!-- check input access for staff_email_harvesting -->
               <?php 
                  $div_count=div_access($project_info,array('staff_email_harvesting'));
                  $access19 = ($div_count < 1) ? "style='display:none;'" :  '' ; 
                  ?>
               <div class="row g-3 align-items-center justify-content-md-center" <?= $access19; ?>>
                  <?php if(in_array('staff_email_harvesting',$project_info)){ ?>
                  <div class="col">
                     <label for="staff_email_harvesting" class="col-form-label">Email Source URL:</label>
                  </div>
                  <div class="col">
                     <input type="text" value="<?=  (!empty($allInfo[0]['staff_email_harvesting'])) ?  $allInfo[0]['staff_email_harvesting'] : ''  ?>" title="Clearbit" id="staff_email_harvesting"  name='staff_email_harvesting' class="form-control form-control-sm">
                  </div>
                  <?php } ?>
               </div>
               <!-- check input access for staff_direct_tel,staff_mobile -->
               <?php 
                  $div_count=div_access($project_info,array('staff_direct_tel','staff_mobile'));
                  $access20 = ($div_count < 1) ? "style='display:none;'" :  '' ; 
                  ?>
               <div class="row g-3 align-items-center justify-content-md-center" <?= $access20; ?>>
                  <?php if(in_array('staff_direct_tel',$project_info)){ ?>
                  <div class="col">
                     <label for="staff_direct_tel" class="col-form-label">Direct Tel:</label>
                     <input type="text" value="<?=  (!empty($allInfo[0]['staff_direct_tel'])) ?  $allInfo[0]['staff_direct_tel'] : ''  ?>" title="" id="staff_direct_tel"  name='staff_direct_tel' class="form-control form-control-sm">
                  </div>
                  <!-- <div class="col">
                     <label for="staff_extension" class="col-form-label">Extension:</label>
                     <input type="text" value="" title="" id="staff_extension"  name='staff_extension' class="form-control form-control-sm">
                     </div> -->
                  <div class="col">
                     <label for="staff_mobile" class="col-form-label">Mobile:</label>
                     <input type="text" value="<?=  (!empty($allInfo[0]['staff_mobile'])) ?  $allInfo[0]['staff_mobile'] : ''  ?>" title="" id="staff_mobile"  name='staff_mobile' class="form-control form-control-sm">
                  </div>
                  <?php } ?>
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
                              <h5><span class="badge bg-danger"><?=  (!empty($allInfo[0]['provided_job_title'])) ?  $allInfo[0]['provided_job_title'] : ''  ?></span></h5>
                           </div>
                           <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button></div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- check input access for web_staff_disposition -->
               <?php 
                  $div_count=div_access($project_info,array('web_staff_disposition'));
                  $access21 = ($div_count < 1) ? "style='display:none;'" :  '' ; 
                  ?>
               <div class="row g-3 align-items-center justify-content-md-center" <?= $access21; ?>>
                  <?php if(in_array('web_staff_disposition',$project_info)){ ?>
                  <div class="col">
                     <label for="web_staff_disposition" class="col-form-label">Web Staff Disposition:</label>
                  </div>
                  <div class="col">
                     <select class='form-control form-control-sm' id="web_staff_disposition"  name='web_staff_disposition'>
                        <option value=''>select Web Disposition</option>
                        <?php 
                        foreach ($webDispos as $key => $val) { ?>
                        <option value='<?= $val['dispositions']; ?>' <?php if($allInfo[0]['web_staff_disposition']==$val['dispositions']){?>selected<?php } ?>><?= $val['dispositions']; ?></option>
                        <?php }
                           ?>
                        <option value='Duplicate'>Duplicate</option>
                     </select>
                  </div>
                  <?php } ?>
               </div>
               <!-- check input access for voice_staff_disposition -->
               <?php 
                  $div_count=div_access($project_info,array('voice_staff_disposition'));
                  $access22 = ($div_count < 1) ? "style='display:none;'" :  '' ; 
                  ?>
               <div class="row g-3 align-items-center justify-content-md-center" <?= $access22; ?>>
                  <?php if(in_array('voice_staff_disposition',$project_info)){ ?>
                  <div class="col">
                     <label for="voice_staff_disposition" class="col-form-label">Voice Staff Disposition:</label>
                  </div>
                  <div class="col">
                     <select class='form-control form-control-sm' id="voice_staff_disposition"  name='voice_staff_disposition'>
                        <option value=''>select Voice Staff Disposition</option>
                        <?php 
                        foreach ($VoiceDispos as $key => $val) { ?>
                        <option value='<?= $val['caller_disposition']; ?>' <?php if($allInfo[0]['voice_staff_disposition']==$val['caller_disposition']){?>selected<?php } ?>><?= $val['caller_disposition']; ?></option>
                        <?php }
                           ?>
                     </select>
                  </div>
                  <?php } ?>
               </div>
               <!-- <div class="row g-3 align-items-center justify-content-md-center">
                  <div class="col">
                      <label for="staff_interest_area" class="col-form-label">Interest Area:</label>
                  </div>
                  <div class="col">
                      <input type="text" value="" title="" id="staff_interest_area"  name='staff_interest_area' class="form-control form-control-sm">
                  </div>
                  </div> -->
               <!-- check input access for voice_staff_disposition -->
               <?php 
                  $div_count=div_access($project_info,array('staff_linkedin_count'));
                  $access23 = ($div_count < 1) ? "style='display:none;'" :  '' ; 
                  ?>
               <div class="row g-3 align-items-center justify-content-md-center" <?= $access23; ?>>
                  <?php if(in_array('staff_linkedin_count',$project_info)){ ?>
                  <div class="col">
                     <label for="staff_linkedin_count" class="col-form-label">Linkedin Connections Count:</label>
                  </div>
                  <div class="col">
                     <input type="number" value="<?=  (!empty($allInfo[0]['staff_linkedin_con'])) ?  $allInfo[0]['staff_linkedin_con'] : ''  ?>" title="" id="staff_linkedin_count"  name='staff_linkedin_count' class="form-control form-control-sm">
                  </div>
                  <?php } ?>
               </div>
               <!-- check input access for voice_staff_disposition -->
               <?php 
                  $div_count=div_access($project_info,array('staff_note'));
                  $access24 = ($div_count < 1) ? "style='display:none;'" :  '' ; 
                  ?>
               <div class="row g-3 align-items-center justify-content-md-center" <?= $access24; ?>>
                  <?php if(in_array('staff_note',$project_info)){ ?>
                  <div class="col">
                     <label for="staff_note" class="col-form-label">Staff Note:</label>
                  </div>
                  <div class="col mb-1">
                     <textarea title="" id="staff_note"  name='staff_note' class="form-control form-control-sm"><?=  (!empty($allInfo[0]['staff_note'])) ?  $allInfo[0]['staff_note'] : ''  ?></textarea>
                  </div>
                  <?php } ?>
               </div>
               <!-- check input access for voice_staff_disposition -->
               <?php 
                  $div_count=div_access($project_info,array('staff_remark'));
                  $access25 = ($div_count < 1) ? "style='display:none;'" :  '' ; 
                  ?>
               <div class="row g-3 align-items-center justify-content-md-center" <?= $access25; ?>>
                  <?php if(in_array('staff_remark',$project_info)){ ?>
                  <div class="col">
                     <label for="staff_remark" class="col-form-label">Staff Remark:</label>
                  </div>
                  <div class="col">
                     <textarea title="" id="staff_remark"  name='staff_remark' class="form-control form-control-sm"><?=  (!empty($allInfo[0]['staff_remark'])) ?  $allInfo[0]['staff_remark'] : ''  ?></textarea>
                  </div>
                  <?php } ?>
               </div>
               <br><br><br>
            </div>
            
            <div class="col">
               <ul class="nav nav-tabs" id="myTab" role="tablist">
                  <li class="nav-item" role="presentation">
                     <button style='font-size:12px' class="nav-link active" id="company-tab" data-bs-toggle="tab" data-bs-target="#company" type="button" role="tab" aria-controls="company" aria-selected="true"><?=  (!empty($allInfo[0]['received_company_name'])) ?  $allInfo[0]['received_company_name'] : ''  ?><?=  (!empty($allInfo[0]['no_of_staff'])) ?  '('.$allInfo[0]['no_of_staff'].')' : '(0)' ?></button>
                  </li>
                  <li class="nav-item" role="presentation">
                     <button style='font-size:12px' class="nav-link" id="project-tab" data-bs-toggle="tab" data-bs-target="#project" type="button" role="tab" aria-controls="project" aria-selected="false"><?=  (!empty($allInfo[0]['project_name'])) ?  $allInfo[0]['project_name'] : ''  ?> <?=  (!empty($allInfo[0]['company_count'])) ?  '('.$allInfo[0]['company_count'].')' : '(0)' ?></button>
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
                           <?php 
                           foreach($staff_list as $staff_list_key => $staff_list_val) {?>
                              <tr class="" <?php if($staff_list_val['first_name'] == $allInfo[0]['first_name']){ ?>style="background: yellow;" <?php } ?>>
                              <td><a href="<?php echo base_url().'Projects/my_projects/'.$staff_list_val['project_id'].'/'.$staff_list_val['id'];?>"><i class="fas fa-eye"></i></a></td>
                              <td><?= $staff_list_val['first_name']; ?></td>
                              <td><?= $staff_list_val['last_name']; ?></td>
                              <td><?= $staff_list_val['company_disposition']; ?></td>
                           </tr>
                           <?php } ?>
                        </table>
                     </div>
                  </div>
                  <div class="tab-pane fade" id="project" role="tabpanel" aria-labelledby="project-tab">
                     <div class='table-responsive' style='height:333px;font-size:12px'>
                        <table class="table table-hover table-bordered table-sm p-0 m-0" width="100%" cellspacing="0" id="project_table">
                           <tr>
                              <th>#</th>
                              <th>Company Name</th>
                              <th>Co. Disposition</th>
                           </tr>
                           <?php 
                           foreach($company_list as $company_list_key => $company_list_val) {?>
                           <tr class="" <?php if($company_list_val['received_company_name'] == $allInfo[0]['received_company_name']){ ?>style="background: yellow;" <?php } ?>>
                              <td><a href="<?php echo base_url().'Projects/my_projects/'.$company_list_val['project_id'].'/'.$company_list_val['id'];?>"><i class="fas fa-eye"></i></a></td>
                              <td><?= $company_list_val['received_company_name']; ?></td>
                              <td></td>
                           </tr>
                           <?php } ?>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </main>
      <script src="<?php echo base_url();?>public/js/bootstrap.bundle.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" crossorigin="anonymous"></script>
      <script>
         $("#country").select2({
         placeholder: " Select Country",
         allowClear: true
         });
         $("#company_disposition").select2({
         placeholder: " Select Co. Disposition",
         allowClear: true
         });
         $("#company_web_dispositon").select2({
         placeholder: " Select Co. Web Disposition",
         allowClear: true
         });
         $("#company_voice_disposition").select2({
         placeholder: " Select Co. Voice Disposition",
         allowClear: true
         });
         $("#web_staff_disposition").select2({
         placeholder: " Select Co. Voice Disposition",
         allowClear: true
         });
         $("#voice_staff_disposition").select2({
         placeholder: " Select Co. Voice Disposition",
         allowClear: true
         });
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
   </body>
</html>