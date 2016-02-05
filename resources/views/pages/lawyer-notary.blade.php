@extends('index')
@section('content')

<div class="bc-bg">
    <ul class="breadcrumb container">
        <li><a href="{{ baseUrl() }}">Home</a></li>
        <li class="active">{{ ucfirst($titles) }}</li>
    </ul>
</div>
<div class="line-top"><h3><small>{{ $titles }}</small></h3></div>
<div class="container">
	<br>
	<div class="tab-container">
		<ul class="nav nav-tabs">
			<li class="active"><a href data-target="#visa-categories" data-toggle="tab"><h4>Visa Categories</h4></a></li>
			<li><a href data-target="#services-of-notary" data-toggle="tab"><h4>Services of Notary</h4></a></li>
			<li><a href data-target="#services-of-lawyer" data-toggle="tab"><h4>Services of Lawyer</h4></a></li>
		</ul>

		<div id="myTabContent" class="tab-content">
			<div class="tab-pane fade active in" id="visa-categories">
				<div class="row">
					<div class="col-md-6 col-md-offset ">
						<a href data-target="#social-culture-visa" data-toggle="tab" style="text-decoration:none;">
							<img src="assets/img/visa_categories/social-culture-visa-icon.png" class="icon-circl">
							<span style="display:inline-block;"><h4>social & culture visa</h4><h4><small>valid for 6 month</small></h4></span>
						</a>
					</div>
					<div class="col-md-6 col-md-offset ">
						<a href data-target="#retirement-visa" data-toggle="tab" style="text-decoration:none;">
							<img src="assets/img/visa_categories/retirement-visa-icon.png" class="icon-circl">
							<span style="display:inline-block;"><h4>retirement visa</h4>
							<h4><small>valid for 1 (one) year</small></h4></span>
						</a>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 col-md-offset ">
						<a href data-target="#single-entry-business" data-toggle="tab" style="text-decoration:none;">
							<img src="assets/img/visa_categories/single-entry-business-visa-icon.png" class="icon-circl">
							<span style="display:inline-block;"><h4>single entry business visa</h4>
							<h4><small>valid for 6 month</small></h4></span>
						</a>
					</div>
					<div class="col-md-6 col-md-offset ">
						<a href data-target="#multiple-entry-business-visa" data-toggle="tab" style="text-decoration:none;">
							<img src="assets/img/visa_categories/multiple-entry-business-visa-icon.png" class="icon-circl">
							<span style="display:inline-block;"><h4>multiple entry business visa</h4>
							<h4><small>valid for 12 month</small></h4>	</span>
						</a>
					</div>
					
					
				</div>	
				<div class="row">
					<div class="col-md-6 col-md-offset ">
						<a href data-target="#family-kitas" data-toggle="tab" style="text-decoration:none;">
							<img src="assets/img/visa_categories/icon-family-kitas.png" class="icon-circl">
							<span style="display:inline-block;"><h4>family kitas</h4>
							<h4><small>valid for 1 (one) year</small></h4></span>
						</a>
					</div>
					
					<div class="col-md-6 col-md-offset ">
						<a href data-target="#working-visa-kitas" data-toggle="tab" style="text-decoration:none;">
							<img src="assets/img/visa_categories/working-visa-icon.png" class="icon-circl">
							<span style="display:inline-block;"><h4>working visa kitas</h4>
							<h4><small>valid for 1 (one) year</small></h4></span>
						</a>
					</div>
				</div>			
				<div class="row">
					<div class="col-md-6 col-md-offset ">
						<a href data-target="#epo" data-toggle="tab" style="text-decoration:none;">
							<img src="assets/img/visa_categories/epo-icon.png" class="icon-circl">
							<span style="display:inline-block;"><h4>epo (exit permit only)</h4>
							<small>&nbsp;</small></span>
						</a>
					</div>
					<div class="col-md-6 col-md-offset ">
						<a href data-target="#pma" data-toggle="tab" style="text-decoration:none;">
							<img src="assets/img/visa_categories/icon-pma.png" class="icon-circl">
							<span style="display:inline-block;"><h4>pma (foreign investment company)</h4>
							<h4><small>Starts from USD 3,600.00</small></h4></span>
						</a>
					</div>
				</div>	
				<div class="row">
					<div class="col-md-6 col-md-offset ">
						<a href data-target="#local-company" data-toggle="tab" style="text-decoration:none;">
							<img src="assets/img/visa_categories/icon-local-company-pt.png" class="icon-circl">
							<span style="display:inline-block;"><h4>local company (pt)</h4>
							<h4><small>Starts from USD 1,800.00</small></h4>	</span>
						</a>
					</div>
					<div class="col-md-6 col-md-offset ">
						<a href data-target="#imb" data-toggle="tab" style="text-decoration:none;">
							<img src="assets/img/visa_categories/icon-imb.png" class="icon-circl">
							<span style="display:inline-block;"><h4>imb (building permit)</h4>
							<small>&nbsp;</small></span>
						</a>
					</div>
				</div>					
			</div>
			<div class="tab-pane fade" id="services-of-notary">
				<div class="row">
					<div class="col-md-6 ">
					    <div class="panel panel-default">
					      	<div class="panel-heading">
					      		<a data-toggle="collapse" href="#notary_consultan"><h4 class="panel-title">NOTARY CONSULTATION</h4></a>
					      	</div>
					      	<div id="notary_consultan" class="panel-collapse collapse">
					        	<div class="panel-body">
					        		<p><dt class="text-info">USD 70.00</dt> You can have consultation with our partner, public notary on creating a business or investment and every aspect of state legal documents</p>
					        	</div>
					      	</div>
					    </div>
					</div>
					<div class="col-md-6 ">
						<div class="panel panel-default">
					      	<div class="panel-heading">
						        <a data-toggle="collapse" href="#company_deed"><h4 class="panel-title">COMPANY DEED</h4></a>
					      	</div>
					      	<div id="company_deed" class="panel-collapse collapse">
					        	<div class="panel-body">
					        		<p><dt class="text-info">Starts from USD 1,800.00</dt> Made by our partner, public notary. This deed is one of the requirements to starts a new business/ company.</p>
					        	</div>
					      	</div>
					    </div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 ">
						<div class="panel panel-default">
					      	<div class="panel-heading">
						        <a data-toggle="collapse" href="#amandements_of_company_deed"><h4 class="panel-title">AMENDEMENTS OF COMPANY DEED</h4></a>
					      	</div>
					      	<div id="amandements_of_company_deed" class="panel-collapse collapse">
					        	<div class="panel-body">
					        		<p><dt class="text-info">Starts from USD 1,700.00</dt> Made by our partner, public notary. This Amendment is to be made if you want to make changes in your company deed.</p>
					        	</div>
					      	</div>
					    </div>
					</div>
					<div class="col-md-6 ">
						<div class="panel panel-default">
					      	<div class="panel-heading">
						        <a data-toggle="collapse" href="#due_diligence"><h4 class="panel-title">DUE DILIGENCE</h4></a>
						        
					      	</div>
					      	<div id="due_diligence" class="panel-collapse collapse">
					        	<div class="panel-body">
					        		<p><dt class="text-info">Starts from USD 250.00</dt> Is an investigation legal document prior to signing a contract, or an act with a certain standard of care.</p>
					        	</div>
					      	</div>
					    </div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 ">
						<div class="panel panel-default">
					      	<div class="panel-heading">
						        <a data-toggle="collapse" href="#purchased_leasehold_property"><h4 class="panel-title">PURCHASED LEASEHOLD PROPERTY</h4></a>
						        
					      	</div>
					      	<div id="purchased_leasehold_property" class="panel-collapse collapse">
					        	<div class="panel-body">
					        		<p><dt class="text-info">Starts from USD 300.00</dt> This is a package of notary service includes due diligence of the property and purchased deed.</p>
					        	</div>
					      	</div>
					    </div>
					</div>
					<div class="col-md-6 ">
						<div class="panel panel-default">
					      	<div class="panel-heading">
						        <a data-toggle="collapse" href="#purchased_freehold_property"><h4 class="panel-title">PURCHASED FREEHOLD PROPERTY</h4></a>
						        
					      	</div>
					      	<div id="purchased_freehold_property" class="panel-collapse collapse">
					        	<div class="panel-body">
					        		<p><dt class="text-info">Starts from 1% of purchased price</dt> This is a package of notary service includes due diligence of the property and purchased deed.</p>
					        	</div>
					      	</div>
					    </div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 ">
						<div class="panel panel-default">
					      	<div class="panel-heading">
						        <a data-toggle="collapse" href="#deed_of_granting_mortgage"><h4 class="panel-title">DEED OF GRANTING MORTGAGE</h4></a>
						        
					      	</div>
					      	<div id="deed_of_granting_mortgage" class="panel-collapse collapse">
					        	<div class="panel-body">
					        		<p><dt class="text-info">Starts from 1% of the mortgage value</dt> Put in mortgage on title deed of a land.</p>
					        	</div>
					      	</div>
					    </div>
					</div>
					<div class="col-md-6 ">
						<div class="panel panel-default">
					      	<div class="panel-heading">
						        <a data-toggle="collapse" href="#roya"><h4 class="panel-title">ROYA</h4></a>
						        
					      	</div>
					      	<div id="roya" class="panel-collapse collapse">
					        	<div class="panel-body">
					        		<p><dt class="text-info">Starts from USD 150.00</dt> Write off mortgage.</p>
					        	</div>
					      	</div>
					    </div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 ">
						<div class="panel panel-default">
					      	<div class="panel-heading">
						        <a data-toggle="collapse" href="#power_of_attorney"><h4 class="panel-title">POWER OF ATTORNEY</h4></a>
						        
					      	</div>
					      	<div id="power_of_attorney" class="panel-collapse collapse">
					        	<div class="panel-body">
					        		<p><dt class="text-info">USD 50.00</dt> </p>
					        	</div>
					      	</div>
					    </div>
					</div>
					<div class="col-md-6 ">
						<div class="panel panel-default">
					      	<div class="panel-heading">
						        <a data-toggle="collapse" href="#legalize_inventory"><h4 class="panel-title">LEGALIZE INVENTORY</h4></a>
						        
					      	</div>
					      	<div id="legalize_inventory" class="panel-collapse collapse">
					        	<div class="panel-body">
					        		<p><dt class="text-info">USD 250.00</dt></p>
					        	</div>
					      	</div>
					    </div>
					</div>
						
				</div>
				<div class="row">
					<div class="col-md-6 ">
						<div class="panel panel-default">
					      	<div class="panel-heading">
						        <a data-toggle="collapse" href="#legalization_document"><h4 class="panel-title">LEGALIZATION DOCUMENT</h4></a>
						        
					      	</div>
					      	<div id="legalization_document" class="panel-collapse collapse">
					        	<div class="panel-body">
					        		<p><dt class="text-info">USD 150.00</dt> </p>
					        	</div>
					      	</div>
					    </div>
					</div>
					<div class="col-md-6 ">
						<div class="panel panel-default">
					      	<div class="panel-heading">
						        <a data-toggle="collapse" href="#watermark_document"><h4 class="panel-title">WATERMARK DOCUMENT</h4></a>
						        
					      	</div>
					      	<div id="watermark_document" class="panel-collapse collapse">
					        	<div class="panel-body">
					        		<p><dt class="text-info">USD 250.00</dt></p>
					        	</div>
					      	</div>
					    </div>
					</div>
				</div>
				
			</div>
			<div class="tab-pane fade" id="services-of-lawyer">
				<div class="row">
					<div class="col-lg-6 text-justify">
						<h4 class="text-primary">LITIGATION</h4> It is a court handling procedures, either criminal or civil. For criminal, it starts from reporting the opposing party to the police station until the verdict will have been legally binding (could be until Supreme Court). For civil case, it starts from filing the lawsuit to the first instance court until the verdict will have been legally binding (could be until Supreme Court).<br>
						a. Divorce  : USD 3,000. <br>
						b. Non Divorce  : USD 4,200. <br>
						c. If the case is about property, the fee is subject to success fee amount of minimum 10% of the net recovery (negotiable).
					</div>
					<div class="col-lg-6 text-justify">
						<h4 class="text-primary">NON LITIGATION</h4> It is out off-court handling, such as Legal consultancy, negotiation and mediation (as long as out of court handling) for civil court, and out of police process for criminal case. The non litigation process is undertaken until the settlement reached.<br>
						a. Legal Consultation: USD 90.00 per hour. <br>
						b. If the case must be handled through non litigation process, the fee will be USD 1,800 including the consultation fee as set forth above.<br><br>

						The fees set forth above are:<br>
						a. if the client has paid consultation fee, the fee will be deducted by the consultation fee; <br>
						b. for minimum basis in Badung and Denpasar area; <br>
						c. for normal legal process; and <br>
						d. for the first instance court process only; we will charge the client another 50% for appealing process and another 50% for supreme court process.
					</div>
				</div>
			</div>

			<!-- sub tab -->
			<div class="tab-pane fade" id="social-culture-visa">
				<div class="row">
					<div class="col-lg-12">
						<a href data-target="#visa-categories" data-toggle="tab" class="fa fa-arrow-circle-left"> BACK</a><br>
						<img src="assets/img/visa_categories/social-culture-visa-icon.png" class="icon-circl">
						<span style="display:inline-block;"><h4>social & culture visa</h4><h4><small>valid for 6 month</small></h4></span>
					</div>
				</div>
				<div class="row text-justify">
					<div class="col-md-12">
						Untitle The purpose of this visa is to visit friends / relationships, social - cultural or educational exchange. With this visa you are not allowed to do business activities in Indonesia or to take up employment. Sponsorship is required by an Indonesian citizen that have Bali ID card. You need to supply the following documents: The social & culture visa ( Visa Index 211) is a single entry visa that cannot be used for working but for all activities which have connection with government, tourism, social and culture, it is given 60 (sixty) days, then extendable 4 times every 30 days. This visa can be sponsored individually.   <strong>This visa is suitable for:</strong><br><br>
						<ul>
							<li><i class="fa fa-arrow-right"></i> Tourism</li>
							<li><i class="fa fa-arrow-right"></i> Social and family</li>
							<li><i class="fa fa-arrow-right"></i> Between educational foundation</li>
							<li><i class="fa fa-arrow-right"></i> Journalist that already has permit from the authority</li>
							<li><i class="fa fa-arrow-right"></i> Conducting business conversation such as sale and purchase of goods and services as well as production or goods quality supervision</li>
							<li><i class="fa fa-arrow-right"></i> Attending international exhibition</li>
							<li><i class="fa fa-arrow-right"></i> Joining a meeting that is organized by the head office or its representative office in Indonesia</li>
						</ul>
						<br>
						Your Indonesian sponsor needs to supply: • Copy of sponsor identity card whose residence is in Bali. You need to supply: • Copy of your passport • 2 (two) passport sized photographs (4 x 6) red background Extension: After the first 60 days you need to extend your visa every 30 days. For 1st and 2nd extension  will took up to 7 working days process and for 3rd and 4th extension will took up to 15 working days process. For each extension you may requested to come to immigration office to take picture. <strong>Cost:</strong><br>&nbsp;
					</div>
					<div class="col-md-6">
						<ul>
							<li>Prepare Sponsor Letter and arrange with agent in Singapore</li>
							<li class="text-warning"><em>Sponsor to be provided by the client </em></li>
							<li>Sponsor by Kibarer Property	</li>
							<li>Extension 1st / 2nd	</li>
							<li>Extension 3rd / 4th	</li>
							<li>Full Package</li>
						</ul>
					</div>
					<div class="col-md-6">
						<ul>
							<li>USD 50.00</li>
							<li>USD 150.00</li>
							<li>USD 100.00 per extension</li>
							<li>USD 120.00 per extension</li>
							<li>USD 400.00 excludes sponsor</li>
							<li>USD 500.00 Includes sponsor</li>
						</ul>
					</div>
					
				</div>
			</div>
			<div class="tab-pane fade" id="single-entry-business">
				<div class="row">
					<div class="col-lg-12">
						<a href data-target="#visa-categories" data-toggle="tab" class="fa fa-arrow-circle-left"> BACK</a><br>
						<img src="assets/img/visa_categories/single-entry-business-visa-icon.png" class="icon-circl">
						<span style="display:inline-block;"><h4>single entry business visa</h4><h4><small>valid for 6 month</small></h4></span>
					</div>
				</div>
				<div class="row text-justify">
					<div class="col-md-12">
						The purpose of this visa is doing business activities in Indonesia which do not involve taking up employment. Sponsorship is required by an Indonesian company. You need provide the following documents: Company sponsor data:<br><br>
						<ul>
							<li><i class="fa fa-arrow-right"></i> Copy of the company’s deed</li>
							<li><i class="fa fa-arrow-right"></i> Copy of Certificate of Ministry of Justice</li>
							<li><i class="fa fa-arrow-right"></i> Copy of the company’s business license letter (SIUP & TDP)</li>
							<li><i class="fa fa-arrow-right"></i> Copy of Office License and Hinder Ordonnantie (SITU & HO)</li>
							<li><i class="fa fa-arrow-right"></i> Copy of the company’s locality letter (SKTU)</li>
							<li><i class="fa fa-arrow-right"></i> Copy of the company’s tax number (NPWP)</li>
							<li><i class="fa fa-arrow-right"></i> Copy of the director’s identity card</li>
							<li><i class="fa fa-arrow-right"></i> 5 company letters head, signed by the one of the manager and sealed with the company stamp.</li>
						</ul>
						<br>
						Foreigner data:<br>
						<ul>
							<li><i class="fa fa-arrow-right"></i> Copy of the foreigner’s passport</li>
							<li><i class="fa fa-arrow-right"></i> 2 (two) passport sized photograph (4 X 6)</li>
						</ul>
						<br>
						<strong>The procedure:</strong> When we have received your documents we will start to process. The above document needs to be sending to Jakarta for approval. A fee is payable in local currencies for the visa application and duration of stay is depending on the embassies/ consulate where the visa is applied but we highly recommend you to go to  Singapore as you can use an agent for one day service. Extension: After the first 60 days you need to extend your visa every 30 days. For 1st and 2nd extension  will took up to 7 working days process and for 3rd and 4th extension will took up to 15 working days process. For each extension you may requested to come to immigration office to take picture.   <strong>Cost :</strong> <br> &nbsp;
					</div>
					<div class="col-md-6">
						<ul>
							<li>Prepare Sponsor Letter and arrange with agent in Singapore</li>
							<li class="text-warning"><em>Company Sponsor to be provided by the client </em></li>
							<li>Sponsor by Kibarer Property	</li>
							<li>Extension 1st / 2nd	</li>
							<li>Extension 3rd / 4th	</li>
							<li>Full Package</li>
						</ul>
					</div>
					<div class="col-md-6">
						<ul>
							<li>USD 50.00</li>
							<li>USD 150.00</li>
							<li>USD 100.00 per extension</li>
							<li>USD 120.00 per extension</li>
							<li>USD 400.00 excludes sponsor</li>
							<li>USD 500.00 Includes sponsor</li>
						</ul>
					</div>
					
				</div>
			</div>
			<div class="tab-pane fade" id="multiple-entry-business-visa">
				<div class="row">
					<div class="col-lg-12">
						<a href data-target="#visa-categories" data-toggle="tab" class="fa fa-arrow-circle-left"> BACK</a><br>
						<img src="assets/img/visa_categories/multiple-entry-business-visa-icon.png" class="icon-circl">
						<span style="display:inline-block;"><h4>multiple entry business visa</h4><h4><small>valid for 12 month</small></h4>	</span>
					</div>
				</div>
				<div class="row text-justify">
					<div class="col-md-12">
						The purpose of this visa is doing business activities in Indonesia which do not involve taking up employment. Sponsorship is required by an Indonesian company for instance in Bali. You need provide the following documents: Company sponsor data:<br><br>
						<ul>
							<li><i class="fa fa-arrow-right"></i> Copy of the company’s deed</li>
							<li><i class="fa fa-arrow-right"></i> Copy of Certificate of Ministry of Justice</li>
							<li><i class="fa fa-arrow-right"></i> Copy of the company’s business license letter (SIUP &TDP)</li>
							<li><i class="fa fa-arrow-right"></i> Copy of  Office License and Hinder Ordonnantie (SITU & HO)</li>
							<li><i class="fa fa-arrow-right"></i> Copy of the company’s locality letter (SKTU)</li>
							<li><i class="fa fa-arrow-right"></i> Copy of the company’s tax number (NPWP)</li>
							<li><i class="fa fa-arrow-right"></i> Copy of the company's bank account statements</li>
							<li><i class="fa fa-arrow-right"></i> Copy of the director’s identity card</li>
							<li><i class="fa fa-arrow-right"></i> Two company letters head, signed by the director and sealed with the company stamp.</li>
						</ul>
						<br>
						Foreigner data:<br>
						<ul>
							<li><i class="fa fa-arrow-right"></i> Copy of the foreigner’s passport</li>
							<li><i class="fa fa-arrow-right"></i> 2 (two) passport sized photograph (4 X 6)</li>
						</ul>
						<br>
						<strong>The procedure:</strong> When we have received your documents we will start to process. The above document needs to be sending to Jakarta for approval. If you application is approved you will receive telex visa, this process can take up 15 working days before a decision is made and the visa granted. A fee is payable in local currencies for the visa application and duration of stay is depending on the embassies/ consulate where the visa is applied but we highly recommend you to go to  Singapore as you can use an agent for one day service. BUT you only can stay in Bali maximum 60 days.<strong> Cost :</strong> <br> &nbsp;
						USD 500.00 The service is include prepare and arrange with the related departments in Jakarta to have your telex and arrange with agent in Singapore.
					</div>
				</div>
			</div>
			<div class="tab-pane fade" id="retirement-visa">
				<div class="row">
					<div class="col-lg-12">
						<a href data-target="#visa-categories" data-toggle="tab" class="fa fa-arrow-circle-left"> BACK</a><br>
						<img src="assets/img/visa_categories/retirement-visa-icon.png" class="icon-circl">
						<span style="display:inline-block;"><h4>retirement visa</h4><h4><small>valid for 1 (one) year</small></h4></span>
					</div>
				</div>
				<div class="row text-justify">
					<div class="col-md-12">
						The retirement visa (Visa Index 311) is a temporary stay permit for retirement purposes. The process time will take up to 2 months. Retirement Visa for Bali Indonesia If you are over 55 years and are able to support yourself fully you may be allowed to retire in Indonesia especially in Bali on an extended temporary basis. To be eligible for a visa for retirement you must:<br><br>
						<ul>
							<li><i class="fa fa-arrow-right"></i> Be 55 years or older</li>
							<li><i class="fa fa-arrow-right"></i> Have no intention to work in Indonesia</li>
							<li><i class="fa fa-arrow-right"></i> Be in good health and character</li>
						</ul>
						<br>
						The requirement:<br>
						<ul>
							<li><i class="fa fa-arrow-right"></i> The following document must be supplied before your visa application can be processed:</li>
							<li><i class="fa fa-arrow-right"></i> Copy of your passport which are valid for at least one year</li>
							<li><i class="fa fa-arrow-right"></i> Proof of holding a pension or deposit – current month of Bank statement</li>
							<li><i class="fa fa-arrow-right"></i> Health and life Insurance</li>
							<li><i class="fa fa-arrow-right"></i> Photographs with Red Background (soft copy)</li>
							<li><i class="fa fa-arrow-right"></i> Have accommodation in Bali with rental agreement.</li>
							<li><i class="fa fa-arrow-right"></i> Any applicant whose spouse wishes to apply for a Retirement Visa must provide a copy of their marriage certificate</li>
							<li><i class="fa fa-arrow-right"></i> Employment Letter. You must employ at least one Indonesian citizen for assistances kind of work, such as nursing or housekeeping during your stay in Indonesia. In that regard, you must submit a letter stating that you are currently employing or intend to employ an Indonesian assistant. ID of the employee.</li>
						</ul>
						<br>
						<strong>How long may I stay?</strong> If your application is approved, you will be allowed to come to Indonesia initially for one year and your visa can be extended every year to a total of 5 years. When finished you will receive the following documents:<br>
						1. KITAS, limited stay permit card.<br> 2. MERP, Multiple Exit Re-Entry Permit.<br> 3. STM, report certificate from the police.<br><br>

						<strong>What if I need to go overseas?</strong> You should check that the availability of your KITAS (Limited Stay Permit Card) is still valid for applying the following Exit Re-entry Permits. Multiple Exit re-entry permit that is valid for 11 months. What if I do not extend the visa? After you finished your visa in one year and do not want to extend, you must apply for an Exit Permit Only (EPO).<strong> Cost :</strong>  USD 1,100.00
					</div>
				</div>
			</div>
			<div class="tab-pane fade" id="family-kitas">
				<div class="row">
					<div class="col-lg-12">
						<a href data-target="#visa-categories" data-toggle="tab" class="fa fa-arrow-circle-left"> BACK</a><br>
						<img src="assets/img/visa_categories/icon-family-kitas.png" class="icon-circl">
						<span style="display:inline-block;"><h4>family kitas</h4><h4><small>valid for 1 (one) year</small></h4></span>
					</div>
				</div>
				<div class="row text-justify">
					<div class="col-md-12">
						KITAS for spouse and/or member of your family. Valid for 1 year and extendable. Documents required:<br><br>
						<ul>
							<li><i class="fa fa-arrow-right"></i> Copy of the wife’s and children’s passport</li>
							<li><i class="fa fa-arrow-right"></i> Copy of the marriage certificate</li>
							<li><i class="fa fa-arrow-right"></i> Copy of the children’s birth certificate</li>
							<li><i class="fa fa-arrow-right"></i> Passport sized photograph (4 X 6 = 8 pieces, 3 X 4 = 6 pieces, 2 X 3 = 6 pieces)</li>
							<li><i class="fa fa-arrow-right"></i> Copy of the family register</li>
						</ul>
						<br>
						<strong>Procedure:</strong> When we received your documents we will start to process. The documents have to be send to Jakarta for approval. If your application is approved you will receive a telex visa, this process can take up to 30 days before a decisions is made and the visa is granted. When telex visa is issued you can apply for the visa at an Indonesian embassy or consulate overseas near to you. A fee is payable in local currencies for the visa application and duration of stay – processing depends on the embassy / consulate where the visa is requested. When you get your visa, you must return to Indonesia straightaway and report to immigration within a maximum of 7 days from the arrival date. The process can take up to 30 days in immigration and then you get the following documents:<br>
						1. KITAS, limited stay permit card.<br>2. MERP, Multiple Exit Re-Entry Permit.<br>3. STM, report certificate from the police.<br>
						<br>
						The above documents are valid for one ( 1 ) year. <br>
						<strong>What if I need to go overseas?</strong> You must apply exit re-entry permit in Immigration, which we will put this in to the package in the working visa. Multiple exit re-entry permit valid for 11 months will took about 3 working days to process.<strong> Cost :</strong>    Starts from USD 890.00/ Person<br>
						The package cost includes multiple exit re-entry permits.  
					</div>
				</div>
			</div>
			<div class="tab-pane fade" id="working-visa-kitas">
				<div class="row">
					<div class="col-lg-12">
						<a href data-target="#visa-categories" data-toggle="tab" class="fa fa-arrow-circle-left"> BACK</a><br>
						<img src="assets/img/visa_categories/working-visa-icon.png" class="icon-circl">
						<span style="display:inline-block;"><h4>working visa kitas</h4><h4><small>valid for 1 (one) year</small></h4></span>
					</div>
				</div>
				<div class="row text-justify">
					<div class="col-md-12">
						The working visa or kitas is a temporary stay visa used for working purposes in Indonesia and is valid for a period of 1 (one) year. The process will take up to 2 months. <strong>This visa is suitable for:</strong><br><br>
						<ul>
							<li><i class="fa fa-arrow-right"></i> Working as an expert with temporary stay permit</li>
							<li><i class="fa fa-arrow-right"></i> Individual cooperation with Indonesian Government</li>
							<li><i class="fa fa-arrow-right"></i> Private Organization Cooperation with Indonesian Government</li>
							<li><i class="fa fa-arrow-right"></i> Private Foreign Investment with Indonesian Government</li>
							<li><i class="fa fa-arrow-right"></i> Joining of working on the boat or floating that operated under the territory of Indonesian Water, territorial sea or continent landing installation as well as Indonesian Exclusive Economy Zone with Temporary Stay Permit (KITAS)</li>
							<li><i class="fa fa-arrow-right"></i> Conducting activities that have connection with profession as to receiving payment, sport, artist, entertainment, consultant, trading and other profession that already has permit from the authority</li>
							<li><i class="fa fa-arrow-right"></i> Giving guidance and counseling as well as training in application and Industrial Technology Innovation to improve the quality of industrial product design and to have overseas marketing cooperation for Indonesia</li>
							<li><i class="fa fa-arrow-right"></i> Conducting the activity in term of commercial movie production that already has permit from the authority</li>
						</ul>
						<br>
						<strong>Working permit visa / KITAS</strong> For foreigners who want to stay and work in Indonesia. You will need a sponsorship from an Indonesian based company. The company sponsored you needs to supply the following documents to process KITAS:<br>
						<ul>
							<li><i class="fa fa-arrow-right"></i> Copy of company’s Deed</li>
							<li><i class="fa fa-arrow-right"></i> Copy of Certificate of Ministry of Justice</li>
							<li><i class="fa fa-arrow-right"></i> Copy of domicile of company (SKTU)</li>
							<li><i class="fa fa-arrow-right"></i> Copy of the company’s tax number (NPWP)</li>
							<li><i class="fa fa-arrow-right"></i> Copy of  Office License and Hinder Ordonnantie (SITU & HO)</li>
							<li><i class="fa fa-arrow-right"></i> Copy of the company listed certification (SIUP &TDP)</li>
							<li><i class="fa fa-arrow-right"></i> Copy of the director’s identity card</li>
							<li><i class="fa fa-arrow-right"></i> Copy of the KTP of an Indonesian work colleague</li>
							<li><i class="fa fa-arrow-right"></i> 20 company letter heads, signed by the company director and sealed with the company stamp</li>
							<li><i class="fa fa-arrow-right"></i> Organization Structure</li>
						</ul>
						<br>
						Foreign applicants papers needed to process KITAS: <br>
						<ul>
							<li><i class="fa fa-arrow-right"></i> Copy of the foreigner’s passport</li>
							<li><i class="fa fa-arrow-right"></i> Curriculum Vitae/ Resume</li>
							<li><i class="fa fa-arrow-right"></i> Copy of Certificate from University</li>
							<li><i class="fa fa-arrow-right"></i> Passport photographs with red backgrounds (soft copy)</li>
						</ul>
						<strong>Procedure:</strong> The above documents need to be sent to Jakarta for approval. If your application is approved you will receiving a telex visa, this process can take up 40 working days before a decision is made and the visa granted. When the telex visa is issued you can apply for the real visa at the Indonesia embassy or consulate overseas, nearest to you.  We highly suggest you to go to Singapore as it is hassle free and will not have complication with the Indonesian embassy there. When you get your visa, you must return to Indonesia and then report to Immigration maximum 7 days within the arrival date. We can do all this for you and guide you in processing. The process can take up within 14 days in Immigration offices. When finished you will receive the following documents:<br>
						a. KITAS, limited stay permit card<br>
						b. MERP, Multiple Exit Re-Entry Permit<br>
						c. STM, report certificate from the police<br>
						d. IMTA, working permit<br>
						<br>
						<strong>What if I need to go overseas?</strong> You must apply exit re-entry permit in Immigration, which we will put this in to the package in the working visa. Multiple exit re-entry permit valid for 11 months will took about 3 working days to process. <strong> Cost :</strong> USD 890.00<br>
						The package cost includes multiple exit re-entry permit but excludes the tax to the government USD 1200 to the government for your 1 whole year stay in Indonesia.
					</div>
				</div>
			</div>
			<div class="tab-pane fade" id="epo">
				<div class="row">
					<div class="col-lg-12">
						<a href data-target="#visa-categories" data-toggle="tab" class="fa fa-arrow-circle-left"> BACK</a><br>
						<img src="assets/img/visa_categories/epo-icon.png" class="icon-circl">
						<span style="display:inline-block;"><h4>epo (exit permit only)</h4><small>&nbsp;</small></span>
					</div>
				</div>
				<div class="row text-justify">
					<div class="col-md-12">
						EPO is needed if you don’t want to extend your Working or Retirement Kitas or you want to change the sponsor. The requirement: 
						<ul>
							<li>1. Original passport </li>
							<li>2. Original blue book </li>
							<li>3. Original KITAS </li>
							<li>4. Original DPKK slip </li>
							<li>5. Original IMTA slip </li>
							<li>6. Copy of ticket </li>
							<li>7. Copy of company’s document:
								<ul style="margin-left:30px;">
									<li>a. TDP</li>
									<li>b. NPWP</li>
									<li>c. SIUP</li>
									<li>d. Certificate from notary</li>
									<li>e. Company certificate from notary if there’s any change</li>
									<li>f. Certificate of business domicile (SKTU)</li>
								</ul>
							</li>
							<li>8. 10 sheets of empty letterhead which already signed and stamped by director or sponsor</li>
						</ul>
						<br>
						<strong> Cost :</strong>  USD 120.00
					</div>
				</div>
			</div>
			<div class="tab-pane fade" id="pma">
				<div class="row">
					<div class="col-lg-12">
						<a href data-target="#visa-categories" data-toggle="tab" class="fa fa-arrow-circle-left"> BACK</a><br>
						<img src="assets/img/visa_categories/icon-pma.png" class="icon-circl">
						<span style="display:inline-block;"><h4>pma (foreign investment company)</h4><h4><small>Starts from USD 3,600.00</small></h4></span>
					</div>
				</div>
				<div class="row text-justify">
					<div class="col-md-12">
						The difference from Limited Liability Company and PMA (Foreign Investment) is that the PMA should be through Investment Coordinating Board to obtain consent. Requirements for PMA business license in Bali
						<ul>
							<li><i class="fa fa-arrow-right"></i> Photocopy Passport of Foreign shareholder and overseas address.</li>
							<li><i class="fa fa-arrow-right"></i> Photo Copy of Article of Association (Articles of Incorporation) Foreign Enterprises including address [if shareholder Foreign Legal Entity]</li>
							<li><i class="fa fa-arrow-right"></i> Photograph Copy of ID and Tax Number (NPWP) of WNI shareholders</li>
							<li><i class="fa fa-arrow-right"></i> The photo Copy Identity (ID / Passport) members of the President and Board of Commissioners</li>
							<li><i class="fa fa-arrow-right"></i> Lease Agreement and IMB of the building / office</li>
							<li><i class="fa fa-arrow-right"></i> Domicile Certificate owners of office buildings stand</li>
							<li><i class="fa fa-arrow-right"></i> Name or PT Enterprises, along Address Phone Number Office, Field conducted the total capital of the Company, the division of Stock Composition and arrangement of the Board of Directors.</li>
						</ul>
						<br>
						Documents received for governance and business license PMA in bali.<br>
						<ul>
							<li><i class="fa fa-arrow-right"></i> Registration of Investment (BKPM)</li>
							<li><i class="fa fa-arrow-right"></i> Company Deed from Public Notary</li>
							<li><i class="fa fa-arrow-right"></i> Domicile of Company</li>
							<li><i class="fa fa-arrow-right"></i> Company Tax Number (NPWP)</li>
							<li><i class="fa fa-arrow-right"></i> Verification from Minister of Justice</li>
							<li><i class="fa fa-arrow-right"></i> Company Listed Certification (Tanda Daftar Perusahaan)</li>
							<li><i class="fa fa-arrow-right"></i> Statement from the State (Berita Negara)</li>
							<li><i class="fa fa-arrow-right"></i> IUT (Ijin Usaha Tetap) – It’s a certification from the state that you will have after one (1) year operation. This IUT is not included in the package.</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="tab-pane fade" id="local-company">
				<div class="row">
					<div class="col-lg-12">
						<a href data-target="#visa-categories" data-toggle="tab" class="fa fa-arrow-circle-left"> BACK</a><br>
						<img src="assets/img/visa_categories/icon-local-company-pt.png" class="icon-circl">
						<span style="display:inline-block;"><h4>local company (pt)</h4><h4><small>Starts from USD 1,800.00</small></h4>	</span>
					</div>
				</div>
				<div class="row text-justify">
					<div class="col-md-12">
						The company can sponsored foreign employees for their working permit and also can sponsored your foreign client and or visitor for business Visa. Requirements for PT business license in Bali
						<ul>
							<li><i class="fa fa-arrow-right"></i> Name or PT Enterprises, along Address Phone Number Office, Field conducted the total capital of the Company, the division of Stock Composition and arrangement of the Board of Directors.</li>
							<li><i class="fa fa-arrow-right"></i> Photograph Copy of ID and Tax Number (NPWP) of minimum 2 shareholders</li>
							<li><i class="fa fa-arrow-right"></i> Lease Agreement and IMB of the building / office</li>
						</ul>
						<br>
						Documents received for governance and business license PT in Bali.<br>
						<ul>
							<li><i class="fa fa-arrow-right"></i> Company Deed from Public Notary</li>
							<li><i class="fa fa-arrow-right"></i> Statement from the State (Berita Negara)</li>
							<li><i class="fa fa-arrow-right"></i> Certificate of Ministry of Justice</li>
							<li><i class="fa fa-arrow-right"></i> Domicile of Company (SKTU)</li>
							<li><i class="fa fa-arrow-right"></i> Company Tax Number (NPWP)</li>
							<li><i class="fa fa-arrow-right"></i> SITU and HO</li>
							<li><i class="fa fa-arrow-right"></i> Company Listed Certification (TDP & SIUP)</li>
							<li><i class="fa fa-arrow-right"></i> UKL/UPL – depends on the business nature of the company</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="tab-pane fade" id="imb">
				<div class="row">
					<div class="col-lg-12">
						<a href data-target="#visa-categories" data-toggle="tab" class="fa fa-arrow-circle-left"> BACK</a><br>
						<img src="assets/img/visa_categories/icon-imb.png" class="icon-circl">
						<span style="display:inline-block;"><h4>imb (building permit)</h4><small>&nbsp;</small></span>
					</div>
				</div>
				<div class="row text-justify">
					<div class="col-md-12">
						IMB is needed either for your residence or business residence. The process will take around 2-3 months and the cost will depends on location and the size of the building. Requirements for IMB in Bali<br>
						1. Complete drawing of the building.<br> 2. Building address.<br> 3. The propose of the building.<br>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>	

@stop