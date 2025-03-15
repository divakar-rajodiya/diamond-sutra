@extends('layouts.site')
@section('content')

<main>
    <div class="page-title">
        <div class="container">
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <!-- <li class="breadcrumb-item"><a href="index.html">Home</a></li> -->
                        <li class="breadcrumb-item"><a href="#">Ring Size Guide</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="py-sm-5 py-4 fs-14">
        <div class="container">

            <div class="mb-4">
                <h6 class="fw-bold border-bottom mb-2 pb-2">To find the right size for your next Diamond Sutra ring, you can:</h6>
                <ul>
                    <li>Use the printable tool</li>
                    <li>Use the measuring guide</li>
                </ul>
            </div>
            <div class="mb-4">
                <p class="mb-2">Select your preferred method below and follow the steps to find your size.</p>
            </div>

            <div class="mb-4">
                <h6 class="fw-bold border-bottom mb-2 pb-2">PRINTABLE SIZING TOOL</h6>
                <p class="mb-2">Diamond Sutra has created this printable sizing tool to help identify your correct size.</p>
                <ul>
                    <li>Download the printable tool here and print it.<div class="mb-4 mt-4"><a class="btn btn-outline-dark fs-12 shadow" href="{{url('public/assets/img/ring_size.pdf')}}" download>CLICK TO DOWNLOAD</a></div></li>
                    <li>Follow the instructions on the printable tool and find your size. If you hesitate between 2 sizes, Diamond Sutra recommends choosing the larger size.</li>
                    <li> Use size chart at the bottom of this page. Look for the size you found with the tool in the 1st column (named “finger circumference in MM”) to then find the right size by Diamond Sutra collection.</li>
                </ul>
            </div>

            <div class="mb-4">
                <h6 class="fw-bold border-bottom mb-2 pb-2">MEASURING GUIDE</h6>
                <p class="mb-2">To determine your ring size, we strongly advise that you measure the size of your finger rather than the size of another ring.</p>
                <ul>
                    <li>Using a length of string or ribbon, wrap it around the base of your finger. To ensure the ring fits comfortably, we suggest measuring your knuckle as well.</li>
                    <li>With a pen, mark the point on the string where the end meets.</li>
                    <li>Measure the string in millimetres (recommended) or inches with a ruler.</li>
                    <li>Use size chart at the bottom of this page. Refer to the size you found in the 1st column (named “finger circumference in MM”) to then find the right size by Diamond Sutra collection.</li>
                </ul>
            </div>

            <div class="mb-4">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" class="text-uppercase"><b>Circumference(mm)</b></th>
                                <th scope="col" class="text-uppercase"><b>Ring Size</b></th>
                                <th scope="col" class="text-uppercase"><b>Circumference(mm)</b></th>
                                <th scope="col" class="text-uppercase"><b>Ring Size</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>44</td>
                                <td>4</td>
                                <td>57</td>
                                <td>17</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>5</td>
                                <td>58</td>
                                <td>18</td>
                            </tr>
                            <tr>
                                <td>46</td>
                                <td>6</td>
                                <td>59</td>
                                <td>19</td>
                            </tr>
                            <tr>
                                <td>47</td>
                                <td>7</td>
                                <td>60</td>
                                <td>20</td>
                            </tr>
                            <tr>
                                <td>48</td>
                                <td>8</td>
                                <td>60</td>
                                <td>21</td>
                            </tr>
                            <tr>
                                <td>49</td>
                                <td>9</td>
                                <td>60</td>
                                <td>22</td>
                            </tr>
                            <tr>
                                <td>50</td>
                                <td>10</td>
                                <td>60</td>
                                <td>23</td>
                            </tr>
                            <tr>
                                <td>51</td>
                                <td>11</td>
                                <td>60</td>
                                <td>24</td>
                            </tr>
                            <tr>
                                <td>52</td>
                                <td>12</td>
                                <td>60</td>
                                <td>25</td>
                            </tr>
                            <tr>
                                <td>53</td>
                                <td>13</td>
                                <td>60</td>
                                <td>26</td>
                            </tr>
                            <tr>
                                <td>54</td>
                                <td>14</td>
                                <td>60</td>
                                <td>27</td>
                            </tr>
                            <tr>
                                <td>55</td>
                                <td>15</td>
                                <td>60</td>
                                <td>28</td>
                            </tr>
                            <tr>
                                <td>56</td>
                                <td>16</td>
                                <td>60</td>
                                <td>29</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
    </div>
</main>

@stop
@section('footer')
@stop