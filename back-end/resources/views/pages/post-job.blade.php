@include('layouts/header')

<!-- bradcam_area  -->
<div class="bradcam_area bradcam_bg_1" style="margin: -25px">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bradcam_text">
                    <h3>Post a Job</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ bradcam_area  -->

<!-- Start Align Area -->
<div class="whole-wrap">
    <div class="container box_1170">
        <div class="section-top-border">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <form action="#">
                        <div class="mt-10">
                            <input type="text" name="first_name" placeholder="Position"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Position'" required
                                class="single-input">
                        </div>
                        <div class="input-group-icon mt-10">
                            <div class="icon"><img src="images/down.png" alt=""></div>
                            <div class="form-select" id="default-select">
                                <select>
                                    <option value="1">Intern</option>
                                    <option value="1">Fresher</option>
                                    <option value="1">Junior</option>
                                    <option value="1">Middle</option>
                                    <option value="1">Senior</option>
                                    <option value="1">Freelancer</option>
                                </select>
                            </div>
                        </div>
                        <div class="input-group-icon mt-10">
                            <div class="icon"><img src="images/down.png" alt=""></div>
                            <div class="form-select" id="default-select">
                                <select>
                                    <option value=" 1">Country</option>
                                    <option value="1">Bangladesh</option>
                                    <option value="1">India</option>
                                    <option value="1">England</option>
                                    <option value="1">Srilanka</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-10">
                            <textarea class="single-textarea" placeholder="Message" onfocus="this.placeholder = ''"
                                onblur="this.placeholder = 'Message'" required></textarea>
                        </div>
                        <div class="mt-10">
                            <input type="text" name="first_name" placeholder="Primary color"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Primary color'" required
                                class="single-input-primary">
                        </div>
                        <div class="mt-10">
                            <input type="text" name="first_name" placeholder="Accent color"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Accent color'" required
                                class="single-input-accent">
                        </div>
                        <div class="mt-10">
                            <input type="text" name="first_name" placeholder="Secondary color"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Secondary color'" required
                                class="single-input-secondary">
                        </div>
                        <div class="mt-10">
                            <button class="boxed-btn3 w-20" type="submit">Submit</button>
                        </div>
                    </form>
                   
                       
                </div>

            </div>
        </div>
    </div>
</div>
<!-- End Align Area -->

@include('layouts/footer')
