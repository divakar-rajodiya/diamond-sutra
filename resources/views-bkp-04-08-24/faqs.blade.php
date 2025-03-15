@extends('layouts.site')
@section('content')

<main>
    <div class="page-title">
        <div class="container">
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <!-- <li class="breadcrumb-item"><a href="index.html">Home</a></li> -->
                        <li class="breadcrumb-item"><a href="#">Faqs</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="about-us py-sm-5 py-4">
        <div class="container">
            
                    <div class="accordion accordion-flush fs-14" id="accordionFaqsOne">
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionFaqsOne-collapseOne" aria-expanded="false" aria-controls="accordionFaqsOne-collapseOne">
                                            Who are we? What makes Diamond Sutra different?
                                        </button>
                                    </h2>
                                    <div id="accordionFaqsOne-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFaqsOne">
                                        <div class="accordion-body">Diamond Sutra stands out for its commitment to quality, transparency, and customer satisfaction. Offering a diverse range of diamond jewellery designs and seamless online shopping, we prioritize excellence in every aspect of our service.</div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionFaqsOne-collapseTwo" aria-expanded="false" aria-controls="accordionFaqsOne-collapseTwo">
                                            Where is Diamond Sutra located?
                                        </button>
                                    </h2>
                                    <div id="accordionFaqsOne-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFaqsOne">
                                        <div class="accordion-body">Based in Jaipur, Rajasthan, Diamond Sutra is situated at the heart of India's renowned jewellery-making heritage.</div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionFaqsOne-collapseThree" aria-expanded="false" aria-controls="accordionFaqsOne-collapseThree">
                                            Where is your jewellery made?
                                        </button>
                                    </h2>
                                    <div id="accordionFaqsOne-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFaqsOne">
                                        <div class="accordion-body">All our jewellery is meticulously crafted in India, blending traditional techniques with contemporary design to create timeless pieces.</div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionFaqsOne-collapseFour" aria-expanded="false" aria-controls="accordionFaqsOne-collapseFour">
                                            Can you customize a design for me?
                                        </button>
                                    </h2>
                                    <div id="accordionFaqsOne-collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionFaqsOne">
                                        <div class="accordion-body">Certainly. We offer complimentary customization services to tailor designs to your exact preferences, however 15 day return policy will not be available for customised products but can be exchanged/buyback*</div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionFaqsOne-collapseNine" aria-expanded="false" aria-controls="accordionFaqsOne-collapseNine">
                                            What is your return policy?
                                        </button>
                                    </h2>
                                    <div id="accordionFaqsOne-collapseNine" class="accordion-collapse collapse" data-bs-parent="#accordionFaqsOne">
                                        <div class="accordion-body"><strong><a href="{{url('returns-policy')}}" target="_blank"> click to show return policy</a> </strong></div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionFaqsOne-collapseEleven" aria-expanded="false" aria-controls="accordionFaqsOne-collapseEleven">
                                            How long does it take to receive my order?
                                        </button>
                                    </h2>
                                    <div id="accordionFaqsOne-collapseEleven" class="accordion-collapse collapse" data-bs-parent="#accordionFaqsOne">
                                        <div class="accordion-body">Your order will typically arrive within 15-20 days as our jewelry is made to order. You can also check the estimated delivery for the your selected piece on its detail page.</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="accordion accordion-flush" id="accordionFaqsTwo">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionFaqsOne-collapseFive" aria-expanded="false" aria-controls="accordionFaqsTwo-collapseFive">
                                                What if the jewellery doesn’t fit me?
                                            </button>
                                        </h2>
                                        <div id="accordionFaqsOne-collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionFaqsOne">
                                            <div class="accordion-body">At Diamond Sutra, we understand the importance of a perfect fit. Therefore, we offer one time complimentary resizing services for all items purchased from us. Simply contact our customer service team, and they will assist you in determining the appropriate size adjustment for your ring.
                                                Please note that additional charges may apply for resizing beyond a certain limit, and the timeframe for resizing may vary depending on the complexity of the adjustment.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionFaqsOne-collapseSix" aria-expanded="false" aria-controls="accordionFaqsTwo-collapseSix">
                                                Do you use gold and natural diamonds?
                                            </button>
                                        </h2>
                                        <div id="accordionFaqsOne-collapseSix" class="accordion-collapse collapse" data-bs-parent="#accordionFaqsOne">
                                            <div class="accordion-body">Yes, we exclusively use hallmarked 18K and 14K gold and ethically sourced, certified natural diamonds.</div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionFaqsOne-collapseSeven" aria-expanded="false" aria-controls="accordionFaqsTwo-collapseSeven">
                                                Is your jewellery certified?
                                            </button>
                                        </h2>
                                        <div id="accordionFaqsOne-collapseSeven" class="accordion-collapse collapse" data-bs-parent="#accordionFaqsOne">
                                            <div class="accordion-body">Absolutely. Our jewellery is hallmarked for gold authenticity, and diamonds come with certifications from respected laboratories such as GIL, SGL, IGI, and GIA.</div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionFaqsOne-collapseEight" aria-expanded="false" aria-controls="accordionFaqsTwo-collapseEight">
                                                Do you offer any additional discounts?
                                            </button>
                                        </h2>
                                        <div id="accordionFaqsOne-collapseEight" class="accordion-collapse collapse" data-bs-parent="#accordionFaqsOne">
                                            <div class="accordion-body">We believe in fair pricing and do not offer additional discounts. Our prices reflect the quality craftsmanship and personalized service that define the Diamond Sutra experience.</div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionFaqsOne-collapseTen" aria-expanded="false" aria-controls="accordionFaqsOne-collapseTen">
                                                What is your exchange policy?
                                            </button>
                                        </h2>
                                        <div id="accordionFaqsOne-collapseTen" class="accordion-collapse collapse" data-bs-parent="#accordionFaqsOne">
                                            <div class="accordion-body"><strong><a href="{{url('lifetime-exchange-buy-back-policy')}}" target="_blank"> click to show exchange policy</a> </strong></div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionFaqsOne-collapseTwelev" aria-expanded="false" aria-controls="accordionFaqsOne-collapseTwelev">
                                                What if my order goes missing during shipping?
                                            </button>
                                        </h2>
                                        <div id="accordionFaqsOne-collapseTwelev" class="accordion-collapse collapse" data-bs-parent="#accordionFaqsOne">
                                            <div class="accordion-body">Rest assured, all shipments are insured by Diamond Sutra. In the unlikely event of loss, we'll conduct thorough investigations and either refund your purchase in full or promptly send a replacement.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                
            </div>
        </div>
    </div>
</main>

@stop
@section('footer')
@stop