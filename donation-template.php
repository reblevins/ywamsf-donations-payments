<?php /* Template Name: Donation Page */ ?>

<?php get_header(); ?>
<?php $al_options = get_option('al_general_settings');?>
<div id="content">
	<h2 class="top-title page-title"><?php the_title(); ?></h2>

	<style type="text/css">
		.alert-box {
		  border-style: solid;
		  border-width: 1px;
		  display: block;
		  font-weight: normal;
		  margin-bottom: 1.11111rem;
		  position: relative;
		  padding: 0.77778rem 1.33333rem 0.77778rem 0.77778rem;
		  font-size: 1rem;
		  background-color: #f08a24;
		  border-color: #de770f;
		  color: white;
		}
	</style>

	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
        <?php the_content(); ?>
    <?php endwhile; ?>

    <?php
      if ( get_query_var( 'err' ) == "The basket is empty" ) {
        $error = "Donation amount field may not be empty";
	    } else {
	      $error = get_query_var( 'err' );
	    }
    	$on = get_query_var( 'on' );

    if ( ( $error != '' ) || ( $on != '' ) ) { ?>

    <div class="alert-box">The following error occurred: <?php echo $error; ?><?php echo $on; ?></div>

    <?php } ?>

	<script>
	jQuery(document).ready(function() {
	  // Initialize the form in case the user has hit the back button
    if ( jQuery( '#donation_designation' ).val() == "Staff Support" ) {
      jQuery("#specification").attr( "placeholder", "Please specify staff member" ).show();
    }
    if ( jQuery( '#donation_designation' ).val() == "Other" ) {
      jQuery("#specification").attr( "placeholder", "Please specify" ).show();
    }
    
    if ( jQuery("#installment-recurring").is(':checked') ) {
      jQuery("#periodicity-options").toggle();
    }
    
    if ( jQuery("#payment-cc" ).is(':checked') ) {
      var payment = jQuery("#cc").html();
    } else {
      var payment = jQuery("#eft").html();
    }
    jQuery("#payment-info").html( payment );
    
	  // Now bind the change observers to the form fields to listen for further changes
	  jQuery("#donation_designation").change(function() {
	    if ( jQuery( this ).val() == "Staff Support" ) {
	      jQuery("#specification").attr( "placeholder", "Please specify staff member" ).show();
	    } else if ( jQuery( this ).val() == "Other" ) {
	      jQuery("#specification").attr( "placeholder", "Please specify" ).show();
	    } else {
	      jQuery("#specification").hide();
	      jQuery("#specification").val('');
	    }
	  });
	  jQuery(".installment").change(function() {
	      jQuery("#periodicity-options").toggle();
	  });
	  jQuery(".payment-type").change(function() {
	    if ( jQuery("#payment-cc" ).is(':checked') ) {
	      var payment = jQuery("#cc").html();
	    } else {
	      var payment = jQuery("#eft").html();
	    }
	    jQuery("#payment-info").html( payment );
	  });
	  jQuery("#Donation").submit(function() {
	    var designation = jQuery("#Donation #donation_designation").val();
	    var specification = jQuery("#Donation #specification").val();
	    
	    if (specification != '') {
	      designation = designation + ': ' + specification;
	    }
	     
	    jQuery("#Donation #ItemName1").val(designation);
	    return true;
	  });
	});
	</script>
	<form id="Donation" action="https://faas.cloud.clickandpledge.com" method="post">
	<fieldset>
		<legend>Donation Designation</legend>
		<select id="donation_designation">
      <option value="Where Needed Most">Where Needed Most</option>
      <option value="Disaster Relief">Disaster Relief</option>
      <option value="Staff Support">Staff Support</option>
      <option value="Five14">Five14</option>
      <option value="DTS Scholarships">DTS Scholarships</option>
      <option value="Other">Other</option>
		</select>    
		<input id="specification" style="display: none" type="text" maxlength="500" size="50" placeholder="Please specify staff member">	
		<input type="hidden" id="ItemName1" name="ItemName1">
	</fieldset>
	<fieldset>  
		<legend>Donation (USD)</legend>  
		
		<input id="UnitPrice1" type="text" name="UnitPrice1" size="10" placeholder="Amount" />  

		<input id="ItemID1" type="hidden" name="ItemID1" value="1" />  

		<input id="Quantity1" type="hidden" name="Quantity1" value="1" />  
		<input id="UnitDeductible1" type="hidden" name="UnitDeductible1" value="100%"> 
		
		<div id="installment-options">
			<label>    
				<input id="installment-onetime" class="installment" type="radio" checked="checked" name="Installment" value="" />
				This is a one-time donation.
			</label>    
			<label>    
				<input id="installment-recurring" class="installment" type="radio" name="Installment" value="999" />
				I want to make a recurring donation.
			</label>
		</div>
		<div id="periodicity-options" style="display: none">
			<label for="Periodicity">Pay every
			</label>
			<select id="Periodicity" name="Periodicity">
				<option value="2 Weeks">2 Weeks</option>
				<option selected="selected" value="Month">Month</option>
				<option value="2 Months">2 Months</option>
				<option value="Quarter">Quarter</option>
				<option value="6 Months">6 Months</option>
				<option value="Year">Year</option>
			</select>
		</div>
	</fieldset>
	<fieldset>  
	  <legend>Contact Information</legend>  
		<input id="BillingFirstName" type="text" name="BillingFirstName" size="30" placeholder="First Name">  
		<input id="BillingLastName" type="text" name="BillingLastName" size="30" placeholder="Last Name">
		<input id="BillingAddress1" type="text" name="BillingAddress1" size="40" placeholder="Address 1">  
		<input id="BillingAddress2" type="text" name="BillingAddress2" size="40" placeholder="Address 2 (optional)">
		<input id="BillingCity" type="text" name="BillingCity" size="40" placeholder="City">
		
		<div id="state">
	  	<select name="BillingStateProvince" size="1" id="BillingStateProvince" >
	  	  <option>Please select state</option><option value="Alabama">Alabama</option>    <option value="Alaska">Alaska</option>    <option value="Arizona">Arizona</option>    <option value="Arkansas">Arkansas</option>    <option value="Armed Forces- Africa">Armed Forces- Africa</option>    <option value="Armed Forces- Americas">Armed Forces- Americas</option>    <option value="Armed Forces- Canada">Armed Forces- Canada</option>    <option value="Armed Forces- Europe">Armed Forces- Europe</option>    <option value="Armed Forces- Middle East">Armed Forces- Middle East</option>    <option value="Armed Forces- Pacific">Armed Forces- Pacific</option>    <option value="California">California</option>    <option value="Colorado">Colorado</option>    <option value="Connecticut">Connecticut</option>    <option value="Delaware">Delaware</option>    <option value="District of Columbia">District of Columbia</option>    <option value="Federated States of Micronesia">Federated States of Micronesia</option>    <option value="Florida">Florida</option>    <option value="Georgia">Georgia</option>    <option value="Guam">Guam</option>    <option value="Hawaii">Hawaii</option>    <option value="Idaho">Idaho</option>    <option value="Illinois">Illinois</option>    <option value="Indiana">Indiana</option>    <option value="Iowa">Iowa</option>    <option value="Kansas">Kansas</option>    <option value="Kentucky">Kentucky</option>    <option value="Louisiana">Louisiana</option>    <option value="Maine">Maine</option>    <option value="Maryland">Maryland</option>    <option value="Massachusetts">Massachusetts</option>    <option value="Michigan">Michigan</option>    <option value="Minnesota">Minnesota</option>    <option value="Mississippi">Mississippi</option>    <option value="Missouri">Missouri</option>    <option value="Montana">Montana</option>    <option value="Nebraska">Nebraska</option>    <option value="Nevada">Nevada</option>    <option value="New Hampshire">New Hampshire</option>    <option value="New Jersey">New Jersey</option>    <option value="New Mexico">New Mexico</option>    <option value="New York">New York</option>    <option value="North Carolina">North Carolina</option>    <option value="North Dakota">North Dakota</option>    <option value="Northern Mariana Islands">Northern Mariana Islands</option>    <option value="Ohio">Ohio</option>    <option value="Oklahoma">Oklahoma</option>    <option value="Oregon">Oregon</option>    <option value="Palau">Palau</option>    <option value="Pennsylvania">Pennsylvania</option>    <option value="Puerto Rico">Puerto Rico</option>    <option value="Rhode Island">Rhode Island</option>    <option value="South Carolina">South Carolina</option>    <option value="South Dakota">South Dakota</option>    <option value="Tennessee">Tennessee</option>    <option value="Texas">Texas</option>    <option value="Utah">Utah</option>    <option value="Vermont">Vermont</option>    <option value="Virgin Islands- US">Virgin Islands- US</option>    <option value="Virginia">Virginia</option>    <option value="Washington">Washington</option>    <option value="West Virginia">West Virginia</option>    <option value="Wisconsin">Wisconsin</option>    <option value="Wyoming">Wyoming</option>
	  	</select>
		</div>
		
		<input id="BillingPostalCode" type="text" name="BillingPostalCode" size="15" placeholder="Zip Code">
		
		<div id="country">
	  	<select name="BillingCountryCode" size="1" id="BillingCountryCode" >  <option selected>Please select country</option> <option value="840">United States of America</option>	<option value="004">Afghanistan</option>  	<option value="008">Albania</option>  	<option value="012">Algeria</option>  	<option value="016">American Samoa</option>  	<option value="020">Andorra</option>  	<option value="024">Angola</option>  	<option value="010">Antarctica</option>  	<option value="028">Antigua and Barbuda</option>  	<option value="032">Argentina</option>  	<option value="051">Armenia</option>  	<option value="533">Aruba</option>  	<option value="036">Australia</option>  	<option value="040">Austria</option>  	<option value="031">Azerbaijan Rep.</option>  	<option value="044">Bahamas </option>  	<option value="048">Bahrain</option>  	<option value="050">Bangladesh</option>  	<option value="052">Barbados</option>  	<option value="112">Belarus</option>  	<option value="056">Belgium</option>  	<option value="084">Belize</option>  	<option value="204">Benin</option>  	<option value="060">Bermuda</option>  	<option value="064">Bhutan</option>  	<option value="068">Bolivia</option>  	<option value="070">Bosnia</option>  	<option value="072">Botswana</option>  	<option value="076">Brazil</option>  	<option value="096">Brunei</option>  	<option value="100">Bulgaria</option>  	<option value="854">Burkina Faso</option>  	<option value="108">Burundi</option>  	<option value="116">Cambodia</option>  	<option value="120">Cameroon</option>  	<option value="124">Canada</option>  	<option value="132">Cape Verde Islands</option>  	<option value="136">Cayman Islands</option>  	<option value="140">Central African Republic</option>  	<option value="148">Chad</option>  	<option value="152">Chile</option>  	<option value="156">China People's Republic</option>  	<option value="170">Columbia</option>  	<option value="174">Comoros</option>  	<option value="178">Congo</option>  	<option value="184">Cook Islands</option>  	<option value="188">Costa Rica</option>  	<option value="191">Croatia</option>  	<option value="192">Cuba</option>  	<option value="196">Cyprus</option>  	<option value="203">Czech Republic</option>  	<option value="208">Denmark</option>  	<option value="262">Djibouti</option>  	<option value="214">Dominican Republic</option>  	<option value="218">Ecuador</option>  	<option value="818">Egypt</option>  	<option value="222">El Salvador</option>  	<option value="226">Equatorial Guinea Malabo</option>  	<option value="232">Eritrea</option>  	<option value="233">Estonia</option>  	<option value="231">Ethiopia</option>  	<option value="242">Fiji Islands</option>  	<option value="246">Finland</option>  	<option value="250">France</option>  	<option value="254">French Guiana</option>  	<option value="258">French Polynesia</option>  	<option value="266">Gabon</option>  	<option value="270">Gambia</option>  	<option value="268">Georgia</option>  	<option value="276">Germany</option>  	<option value="288">Ghana</option>  	<option value="292">Gibraltar</option>  	<option value="300">Greece</option>  	<option value="304">Greenland</option>  	<option value="308">Grenada</option>  	<option value="312">Guadeloupe</option>  	<option value="316">Guam</option>  	<option value="320">Guatemala</option>  	<option value="324">Guinea</option>  	<option value="328">Guyana</option>  	<option value="332">Haiti</option>  	<option value="340">Honduras</option>  	<option value="344">Hong Kong</option>  	<option value="348">Hungary</option>  	<option value="352">Iceland</option>  	<option value="356">India</option>  	<option value="360">Indonesia</option>  	<option value="364">Iran</option>  	<option value="368">Iraq</option>  	<option value="372">Ireland</option>  	<option value="376">Israel</option>  	<option value="380">Italy</option>  	<option value="388">Jamaica</option>  	<option value="392">Japan</option>  	<option value="400">Jordan</option>  	<option value="398">Kazakhstan</option>  	<option value="404">Kenya</option>  	<option value="296">Kiribati</option>  	<option value="410">Korea, Republic of</option>  	<option value="414">Kuwait</option>  	<option value="417">Kyrgystan</option>  	<option value="428">Latvia</option>  	<option value="422">Lebanon</option>  	<option value="426">Lesotho</option>  	<option value="430">Liberia</option>  	<option value="434">Libya</option>  	<option value="438">Liechtenstein</option>  	<option value="440">Lithuania</option>  	<option value="442">Luxembourg</option>  	<option value="446">Macao</option>  	<option value="807">Macedonia</option>  	<option value="450">Madagascar</option>  	<option value="454">Malawi</option>  	<option value="458">Malaysia</option>  	<option value="462">Maldives</option>  	<option value="466">Mali</option>  	<option value="470">Malta</option>  	<option value="584">Marshall Islands</option>  	<option value="474">Martinique</option>  	<option value="478">Mauritania</option>  	<option value="480">Mauritius</option>  	<option value="484">Mexico</option>  	<option value="583">Micronesia</option>  	<option value="498">Moldova</option>  	<option value="492">Monaco</option>  	<option value="496">Mongolia</option>  	<option value="499">Montenegro</option>  	<option value="500">Montserrat</option>  	<option value="504">Morocco</option>  	<option value="508">Mozambique</option>  	<option value="104">Myanmar</option>  	<option value="516">Namibia</option>  	<option value="520">Nauru</option>  	<option value="524">Nepal</option>  	<option value="528">Netherlands</option>  	<option value="530">Netherlands Antilles</option>  	<option value="540">New Caledonia</option>  	<option value="554">New Zealand</option>  	<option value="558">Nicaragua</option>  	<option value="562">Niger</option>  	<option value="566">Nigeria</option>  	<option value="570">Niue</option>  	<option value="580">Northern Mariana Islands</option>  	<option value="578">Norway</option>  	<option value="512">Oman</option>  	<option value="586">Pakistan</option>  	<option value="585">Palau</option>  	<option value="591">Panama</option>  	<option value="598">Papua New Guinea</option>  	<option value="600">Paraguay</option>  	<option value="604">Peru</option>  	<option value="608">Phillippines</option>  	<option value="616">Poland</option>  	<option value="620">Portugal</option>  	<option value="634">Qatar</option>  	<option value="642">Romania</option>  	<option value="643">Russian Federation</option>  	<option value="646">Rwanda</option>  	<option value="654">Saint Helena</option>  	<option value="659">Saint Kitts and Nevis</option>  	<option value="666">Saint Pierre and Miquelon</option>  	<option value="674">San Marino</option>  	<option value="678">Sao Tome and Principe</option>  	<option value="682">Saudi Arabia</option>  	<option value="686">Senegal</option>  	<option value="688">Serbia</option>  	<option value="690">Seychelles</option>  	<option value="694">Sierra Leone</option>  	<option value="702">Singapore</option>  	<option value="703">Slovakia</option>  	<option value="705">Slovenia</option>  	<option value="090">Solomon Islands</option>  	<option value="706">Somalia</option>  	<option value="710">South Africa</option>  	<option value="724">Spain</option>  	<option value="144">Sri Lanka</option>  	<option value="736">Sudan</option>  	<option value="740">Suriname</option>  	<option value="748">Swaziland</option>  	<option value="752">Sweden</option>  	<option value="756">Switzerland</option>  	<option value="760">Syria</option>  	<option value="158">Taiwan</option>  	<option value="762">Tajikistan</option>  	<option value="834">Tanzania</option>  	<option value="764">Thailand</option>  	<option value="772">Tokelau</option>  	<option value="768">Tonga</option>  	<option value="780">Trinidad and Tobago</option>  	<option value="788">Tunisia</option>  	<option value="792">Turkey</option>  	<option value="795">Turkmenistan</option>  	<option value="798">Tuvalu</option>  	<option value="800">Uganda</option>  	<option value="804">Ukraine</option>  	<option value="784">United Arab Emirates</option>  	<option value="826">United Kingdom</option>  	<option value="858">Uruguay</option>  	<option value="860">Uzbekistan</option>  	<option value="548">Vanuatu</option>  	<option value="336">Vatican City</option>  	<option value="862">Venzuela</option>  	<option value="704">Vietnam</option>  	<option value="876">Wallis and Futuna</option>  	<option value="016">Western Samoa</option>  	<option value="887">Yemen, People's Demo. Rep. Of</option>  	<option value="807">Yugoslavia</option>  	<option value="894">Zambia</option>  	<option value="716">Zimbabwe</option>
	  	</select> 
	  </div>	
		<input id="BillingPhone" type="text" name="BillingPhone" size="30" placeholder="Phone Number">  

		<input id="BillingEmail" type="text" name="BillingEmail" size="40" placeholder="Email Address">
		
		<input name= "eNewsletterName1" type="hidden" value="ConstantContact">
		<label id="SubscribeList1Label" for="SubscribeList1"><input name="SubscribeList1" type="checkbox" checked="checked" id="SubscribeList1" value="General Interest"> Please sign me up for your monthly newsletter</label>
	</fieldset>

	<fieldset>
	  <legend>Payment Information</legend>
	  
	  <label>Payment Type</label>
	  
	  <label>    
	  	<input id="payment-cc" class="payment-type" type="radio" checked="checked" name="payment-type" value="cc" />
	  	Credit Card
	  </label>    
	  <label>    
	  	<input id="payment-eft" class="payment-type" type="radio" name="payment-type" value="eft" />
	  	e-Check
	  </label>
	  
	  <div id="payment-info">
	  	<input id="NameOnCard" type="text" name="NameOnCard" size="40" placeholder="Name on Credit Card">  
	  	<input id="CardNumber" type="text" name="CardNumber" size="40" placeholder="Credit Card Number">  
	  	<input id="Cvv2" type="text" name="Cvv2" size="6" placeholder="CV2">  
	    <div id="expirationdate">
	    	<label>Exp. Date</label>  
	    	<select id="ExpirationMonth" name="ExpirationMonth">
	    		<option value="01">January</option>
	    		<option value="02">February</option>
	    		<option value="03">March</option>
	    		<option value="04">April</option>
	    		<option value="05">May</option>
	    		<option value="06">June</option>
	    		<option value="07">July</option>
	    		<option value="08">August</option>
	    		<option value="09">September</option>
	    		<option value="10">October</option>
	    		<option value="11">November</option>
	    		<option value="12">December</option>
	    	</select>
	    	<select id="ExpirationYear" name="ExpirationYear">
	    		<option value="14">2014</option>
	    		<option value="15">2015</option>
	    		<option value="16">2016</option>
	    		<option value="17">2017</option>
	    		<option value="18">2018</option>
	    		<option value="19">2019</option>
	    		<option value="20">2020</option>
	    	</select>  
	    </div><!-- /#expirationdate -->
	  </div><!-- /#payment-info -->
	</fieldset>

		<input id="OnSuccessUrl" type="hidden" name="OnSuccessUrl" value="http://www.ywamsf.org/donation-authorize" />

		<input id="OnDeclineUrl" type="hidden" name="OnDeclineUrl" value="http://www.ywamsf.org/donate" />

		<input id="OnErrorUrl" type="hidden" name="OnErrorUrl" value="http://www.ywamsf.org/donate" />

		<input id="AccountGuid" type="hidden" name="AccountGuid" value="98d10afc-787d-4145-8327-f2b1c7a549ed" />

		<input id="AccountID" type="hidden" name="AccountID" value="28197" />

		<input id="WID" type="hidden" name="WID" value="76417" />

		<input id="RefID" type="hidden" name="RefID" value="Donation" />

		<input id="SendReceipt" type="hidden" name="SendReceipt" value="true" />

		<input id="OrderMode" type="hidden" name="OrderMode" value="Production" />

		<input id="PaymentType" type="hidden" name="PaymentType" value="CreditCard" />

		<input id="TransactionType" type="hidden" name="TransactionType" value="Payment" />

		<input id="DecimalMarkMode" type="hidden" name="DecimalMark" value="US" />

		<input id="Submit" type="submit" name="Submit" value="Make Donation" />
	</form>
	
	<p>&nbsp;</p>
	<p>All donations given to YWAM Colorado Springs Strategic Frontiers (COS-SF) will impact many lives, and help to mobilize, equip, send and sustain missions throughout the least-reached areas of the world (10/40 Window). Full Time YWAM Staff workers dedicate their lives to “Know God and Make Him Known” in the world. YWAM ministry projects are funded by the gifts of God’s people who want to invest in changing the world. Thank you for your gift.</p>
	<p>&nbsp;</p>
	<p>YWAM Colorado Springs Strategic Frontiers is a Non-profit organization 501(c)(3). Per IRS guidelines, all contributions to YWAM COS-SF are income tax deductible and made with the understanding that YWAM COS-SF has discretion over the use of funds. Every attempt is made to honor a donor’s designation of gifts. We acknowledge and receipt all gifts monthly and annually.</p>
	<div id="cc" style="display: none">
		<input id="NameOnCard" type="text" name="NameOnCard" size="40" placeholder="Name on Credit Card">  
		<input id="CardNumber" type="text" name="CardNumber" size="40" placeholder="Credit Card Number">  
		<input id="Cvv2" type="text" name="Cvv2" size="6" placeholder="CV2">  
	  <div id="expirationdate">
	  	<label>Exp. Date</label>  
	  	<select id="ExpirationMonth" name="ExpirationMonth">
	  		<option value="01">January</option>
	  		<option value="02">February</option>
	  		<option value="03">March</option>
	  		<option value="04">April</option>
	  		<option value="05">May</option>
	  		<option value="06">June</option>
	  		<option value="07">July</option>
	  		<option value="08">August</option>
	  		<option value="09">September</option>
	  		<option value="10">October</option>
	  		<option value="11">November</option>
	  		<option value="12">December</option>
	  	</select>
	  	<select id="ExpirationYear" name="ExpirationYear">
	  		<option value="14">2014</option>
	  		<option value="15">2015</option>
	  		<option value="16">2016</option>
	  		<option value="17">2017</option>
	  		<option value="18">2018</option>
	  		<option value="19">2019</option>
	  		<option value="20">2020</option>
	  	</select>  
	  </div><!-- /#expirationdate -->
	</div><!-- /#cc -->

	<div id="eft" style="display: none">
		<input id="AccountNumber" name="AccountNumber" type="text" maxlength="17" size="20" placeholder="Account Number">
	  <input id="RoutingNumber" name="RoutingNumber" type="text" maxlength="9" size="20" placeholder="Routing Number">
	  <select name="AccountType" style="width:250px;">
	    <option selected>Please Select Account Type</option>
	    <option value="CheckingAccount">Checking Account</option>
	    <option value="SavingsAccount">Savings Account</option>
	  </select>
	</div><!-- /#eft -->
	</div>
<?php get_footer(); ?>