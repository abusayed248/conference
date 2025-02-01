<x-app-layout>

    <div class="mt-5">
        <div class="container">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="row sub-menu">
                <div class="col-md-4 my-0">
                    <form action="{{ route('greetings.updateAudio') }}" method="POST" enctype="multipart/form-data">
                        <div class="d-flex bg-green-600 mt-10 justify-content-center flex-column align-items-center">
                            <h3 class="h3">Greeting for Subscribers</h3>

                            @csrf
                            <div class="d-flex justify-content-center align-items-center">
                                <div class="col-md-1">
                                    <label id="file-name" for="file-input"> File</label>
                                </div>
                                <div class="col-md-11">
                                    <div class="custom-file mx-3">
                                        <label id="file-name" class="file-label play" for="file-input">choose File</label>
                                        <input type="file" id="file-input" accept="audio/mp3,audio/*;capture=microphone" name="audio_file" class="file-input" />

                                        <input id="replace-file-input" name="type" type="hidden" style="display:none" value="greetings" class="replace-img" />

                                        <!-- <input type="file" name="audio_file" id="file-input" class="form-control" accept="audio/mp3,audio/wav"> -->
                                    </div>
                                </div>

                            </div>
                            <button id="replace-file-text" type="submit" class="text-decoration  no-style">Replace</button>
                        </div>
                    </form>




                    <form action="{{ route('greetings.updateAudioNonSubscribtion') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="d-flex mt-5 justify-content-center flex-column align-items-center">
                            <h3 class="h3">Greeting for non-subscribers</h3>
                            <div class="d-flex justify-content-center align-items-center">
                                <div class="col-md-1">
                                    <label id="file-name-non-subscribers" for="file-input-non-subscribers"> File</label>
                                </div>
                                <div class="col-md-11">
                                    <div class="custom-file mx-3">
                                        <label id="file-label-non-subscribers" class="file-label play" for="file-input-non-subscribers">choose File</label>

                                        <input type="file" id="file-input-non-subscribers" accept="audio/mp3,audio/*;capture=microphone" name="audio_file" class="file-input" />

                                        <input id="replace-file-input-non-subscribers" name="type" type="hidden" style="display:none" value="non_subscriber_greetings" class="replace-img" />
                                    </div>
                                </div>
                            </div>
                            <button id="replace-file-non-sub-text" type="submit" class="text-decoration no-style">Replace</button>
                        </div>
                    </form>


                    <!-- <input id="replace-non-file-input" accept="audio/mp3,audio/*;capture=microphone" name="non_sub_audio" type="file" style="display:none" class="replace-img" /> -->


                    <div class="mt-5 d-flex justify-content-center">
                        <h3><a class="text-center large-text text-decoration" href="{{ route('manage.subscribers') }}">Manage Subscribers</a></h3>
                    </div>
                </div>

                <div class="col-md-8 py-5 bg-green-600">
                    <div class="row">


                        <div class="col-md-4">
                            <div class="d-flex justify-content-center align-items-center flex-column">
                                <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                                    <?php
                                    $callAction1 = App\Models\CallAction::where('digit', 1)->first();
                                    $selectedFunction = $callAction1 ? $callAction1->type : null; // Get saved type

                                    ?>
                                    <label for="">Function</label>
                                    <select name="cars" id="cars" class="play form-select">
                                        <option value="none" {{ $selectedFunction == 'none' ? 'selected' : '' }}>None</option>
                                        <option value="audio" {{ $selectedFunction == 'audio' ? 'selected' : '' }}>Play MP3</option>
                                        <option value="transfer" {{ $selectedFunction == 'transfer' ? 'selected' : '' }}>Transfer</option>
                                        <option value="sub_menu" {{ $selectedFunction == 'sub_menu' ? 'selected' : '' }}>Submenu</option>
                                    </select>
                                </div>

                                <div id="mp3-section" class="col-md-12" style="display: none;">
                                    <div class="d-flex justify-content-center align-items-center flex-column">
                                        <a id="option-1-replace-file-text" class="text-decoration" href="javascript:void(0)" onclick="triggerFileInputForDigit1()">Replace</a>
                                        <input id="option-1-replace-file-input" type="file" name="option_1_replace" style="display:none"
                                            class="replace-img" accept="audio/mp3,audio/*;capture=microphone" onchange="uploadFileDigit1()" />
                                    </div>
                                </div>

                                <!-- Transfer Section -->
                                <div id="transfer-section" class="col-md-12" style="display: none;">
                                    <div class="d-flex justify-content-center align-items-center flex-column">
                                        <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                                            <label for="">To</label>

                                            <input
                                                name="number"
                                                type="text"
                                                value="{{ @$callAction1->transfer_to}}"
                                                class="w-100"
                                                placeholder="+1123355656"
                                                id="number-input-1"
                                                onblur="saveNumber1()" />
                                        </div>
                                        <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                                            <label for="">Enter after (minutes)</label>
                                            <input name="afer" type="number" readonly class="w-100" value="60" />
                                        </div>
                                    </div>
                                </div>

                                <!-- Submenu Section -->
                                <div id="submenu-section" class="col-md-12" style="display: none;">
                                    <div class="d-flex justify-content-center align-items-center flex-column">
                                        <a id="replace-file-text" class="text-decoration" data-bs-toggle="modal" data-bs-target="#staticBackdrop" href="javascript:void(0)">Edit Submenu</a>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- Play MP3 Section -->




                        <div class="col-md-4">
                            <div class="d-flex justify-content-center align-items-center flex-column">
                                <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                                    <label for="">Function</label>
                                    <select name="type" id="type" form="" value="transfer" class="play">
                                        <option value="volvo">Transfer</option>
                                    </select>
                                </div>
                                <?php
                                $callAction = App\Models\CallAction::query()->where([
                                    'type' => 'transfer',
                                    'digit' => 1
                                ])->first();

                                ?>
                                <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                                    <label for="">To</label>

                                    <input
                                        name="number"
                                        type="text"
                                        value="{{ @$callAction->transfer_to}}"
                                        class="w-100"
                                        placeholder="+1123355656"
                                        id="number-input"
                                        onblur="saveNumber(1 , 60)" />
                                </div>

                                <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                                    <label for="">Enter afer (minutes)</label>
                                    <input name="afer" type="number" readonly class="w-100 " value="60" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 ">
                            <div class="d-flex justify-content-center align-items-center flex-column">
                                <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                                    <label for="">Function</label>
                                    <select name="cars" id="cars" class="play">
                                        <option value="volvo">Play MP3</option>
                                    </select>
                                </div>
                                <!-- <a id="option-2-replace-file-text" class="text-decoration" href="javascript:void(0)" onclick="triggerFileInputForDigit2()">Replace</a>
                                <input
                                    id="option-2-replace-file-input"
                                    type="file"
                                    name="option_2_replace"
                                    style="display:none"
                                    class="replace-img"
                                    accept="audio/mp3,audio/*;capture=microphone"
                                    onchange="uploadFileDigit2()" /> -->
                            </div>
                        </div>

                        <div class="col-md-4 mt-5 ">
                            <div class="d-flex justify-content-center align-items-center flex-column">

                                <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                                    <label for="">Function</label>
                                    <select name="cars" id="cars" class="play form-select" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                        <option value="submenu">Sub-menu</option>
                                    </select>
                                </div>
                                <a id="replace-file-text" class="text-decoration" data-bs-toggle="modal" data-bs-target="#staticBackdrop" href="javascript:void(0)">Edit Submenu</a>
                            </div>

                        </div>



                        <div class="col-md-4 ">
                            <div class="d-flex justify-content-center align-items-center flex-column">
                                <div class="d-flex justify-content-center align-items-center mt-2 w-100">

                                    <label for="">Function</label>

                                    <select name="cars" id="cars" form="" class="play">
                                        <option value="volvo">Play MP3</option>
                                    </select>
                                </div>


                                <a id="option-3-replace-file-text" class="text-decoration" href="javascript:void(0)" onclick="triggerFileInputForDigit3()">Replace</a>
                                <input
                                    id="option-3-replace-file-input"
                                    type="file"
                                    name="option_3_replace"
                                    style="display:none"
                                    class="replace-img"
                                    accept="audio/mp3,audio/*;capture=microphone"
                                    onchange="uploadFileDigit3()" />
                            </div>

                        </div>

                        <div class="col-md-4 mt-5 ">
                            <div class="d-flex justify-content-center align-items-center flex-column">
                                <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                                    <label for="">Function</label>

                                    <select name="cars" id="cars" form="" class="play">
                                        <option value="volvo">Play MP3</option>
                                    </select>
                                </div>

                                <a id="option-4-replace-file-text" class="text-decoration" href="javascript:void(0)" onclick="triggerFileInputForDigit4()">Replace</a>
                                <input
                                    id="option-4-replace-file-input"
                                    type="file"
                                    name="option_4_replace"
                                    style="display:none"
                                    class="replace-img"
                                    accept="audio/mp3,audio/*;capture=microphone"
                                    onchange="uploadFileDigit4()" />
                            </div>

                        </div>
                        <div class="col-md-4 mt-5 ">
                            <div class="d-flex justify-content-center align-items-center flex-column">
                                <div class="d-flex justify-content-center align-items-center mt-2 w-100">

                                    <label for="">Function</label>

                                    <select name="cars" id="cars" class="play">
                                        <option value="volvo">None</option>
                                    </select>

                                </div>
                            </div>

                        </div>
                        <div class="col-md-4 mt-5 ">
                            <div class="d-flex justify-content-center align-items-center flex-column">

                                <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                                    <label for="">Function</label>
                                    <select name="cars" id="cars" class="play form-select" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                        <option value="submenu">Sub-menu</option>
                                    </select>
                                </div>
                                <a id="replace-file-text" class="text-decoration" data-bs-toggle="modal" data-bs-target="#staticBackdrop" href="javascript:void(0)">Edit Submenu</a>
                            </div>

                        </div>
                        <div class="col-md-4 mt-5 ">
                            <div class="d-flex justify-content-center align-items-center flex-column">
                                <div class="d-flex justify-content-center align-items-center mt-2 w-100">

                                    <label for="">Function</label>


                                    <select name="cars" id="cars" form="" class="play">
                                        <option value="volvo">None</option>
                                    </select>

                                </div>
                            </div>

                        </div>
                        <div class="col-md-4 mt-5 ">
                            <div class="d-flex justify-content-center align-items-center flex-column">
                                <div class="d-flex justify-content-center align-items-center mt-2 w-100">

                                    <label for="">Function</label>

                                    <select name="cars" id="cars" form="" class="play">
                                        <option value="Play MP3">Play MP3</option>
                                        <option value="Transfer">Transfer</option>
                                        <option value="Submenu">Submenu</option>
                                    </select>

                                </div>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="d-flex justify-content-center align-items-center flex-column">
                                <div class="d-flex justify-content-center align-items-center mt-2 w-100">

                                    <label for="">Function</label>

                                    <select name="cars" id="cars" form="" class="play">
                                        <option value="volvo">Transfer</option>
                                    </select>
                                </div>
                                <?php
                                $callActionFor9 = App\Models\CallAction::query()->where([
                                    'type' => 'transfer',
                                    'digit' => 9
                                ])->first();
                                ?>
                                <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                                    <label for="">To</label>
                                    <!-- <input type="text" class="w-100" name="option_9" placeholder="+1123355656" /> -->
                                    <input
                                        name="number"
                                        type="text"
                                        value="{{ @$callActionFor9->transfer_to}}"
                                        class="w-100"
                                        placeholder="+1123355656"
                                        id="number-input-9"
                                        onblur="saveNumber9()" />
                                </div>

                                <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                                    <label for="">Enter afer (minutes)</label>
                                    <input type="number" readonly class="w-100" value="2" />
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modal --}}
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">

                <div class="modal-body">
                    <div class="mt-5">
                        <div class="container-fluid">

                            <div class="row sub-menu">
                                <div class="col-md-4 my-0">
                                    <div class="d-flex bg-green-600 mt-10 justify-content-center flex-column align-items-center">
                                        <h3 class="h3">Greeting for Sub-menu</h3>
                                        <div class="d-flex justify-content-center align-items-center">
                                            <div class="col-md-1">
                                                <label id="file-name" for="file-input"> File</label>
                                            </div>
                                            <div class="col-md-11">
                                                <div class="custom-file mx-3">
                                                    <label id="file-name" class="file-label play" for="file-input">choose File</label>
                                                    <input type="file" id="file-input" class="file-input" />
                                                </div>
                                            </div>
                                        </div>

                                        <a id="option-1-sub-menu-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit1SubMenu()">Replace File</a>
                                        <input
                                            id="option-1-sub-menu-replace-file-input"
                                            type="file"
                                            name="option_6_replace"
                                            style="display:none"
                                            class="replace-img"
                                            accept="audio/mp3,audio/*;capture=microphone"
                                            onchange="uploadFileDigit1SubMenu()" />
                                    </div>

                                </div>

                                <div class="col-md-8 py-5 bg-green-600">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="d-flex justify-content-center align-items-center flex-column">
                                                <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                                                    <label for="">Function</label>
                                                    <select name="cars" id="cars" form="" class="play">
                                                        <option value="volvo">Play MP3</option>
                                                        <option value="saab">Saab</option>
                                                        <option value="opel">Opel</option>
                                                        <option value="audi">Audi</option>
                                                    </select>
                                                </div>
                                                <a id="option-1-sub-1-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit1Sub1()">Replace File</a>
                                                <input
                                                    id="option-1-sub-1-replace-file-input"
                                                    type="file"
                                                    name="option_6_replace_sub_1"
                                                    style="display:none"
                                                    class="replace-img"
                                                    accept="audio/mp3,audio/*;capture=microphone"
                                                    onchange="uploadFileDigit1Sub1()" />
                                            </div>
                                        </div>
                                        <div class="col-md-4 ">
                                            <div class="d-flex justify-content-center align-items-center flex-column">
                                                <div class="d-flex justify-content-center align-items-center mt-2 w-100">

                                                    <label for="">Function</label>


                                                    <select name="cars" id="cars" form="" class="play">
                                                        <option value="volvo">Play MP3</option>
                                                        <option value="saab">Saab</option>
                                                        <option value="opel">Opel</option>
                                                        <option value="audi">Audi</option>
                                                    </select>

                                                </div>


                                                <a id="option-1-sub-2-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit1Sub2()">Replace File</a>
                                                <input
                                                    id="option-1-sub-2-replace-file-input"
                                                    type="file"
                                                    name="option_6_replace_sub_1"
                                                    style="display:none"
                                                    class="replace-img"
                                                    accept="audio/mp3,audio/*;capture=microphone"
                                                    onchange="uploadFileDigit1Sub2()" />
                                            </div>

                                        </div>
                                        <div class="col-md-4 ">
                                            <div class="d-flex justify-content-center align-items-center flex-column">
                                                <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                                                    <label for="">Function</label>
                                                    <select name="cars" id="cars" form="" class="play">
                                                        <option value="volvo">Play MP3</option>
                                                        <option value="saab">Saab</option>
                                                        <option value="opel">Opel</option>
                                                        <option value="audi">Audi</option>
                                                    </select>
                                                </div>
                                                <a id="option-1-sub-3-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit1Sub3()">Replace File</a>
                                                <input
                                                    id="option-1-sub-3-replace-file-input"
                                                    type="file"
                                                    name="option_6_replace_sub_1"
                                                    style="display:none"
                                                    class="replace-img"
                                                    accept="audio/mp3,audio/*;capture=microphone"
                                                    onchange="uploadFileDigit1Sub3()" />
                                            </div>

                                        </div>

                                        <div class="col-md-4 mt-5 ">
                                            <div class="d-flex justify-content-center align-items-center flex-column">
                                                <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                                                    <label for="">Function</label>
                                                    <select name="cars" id="cars" form="" class="play">
                                                        <option value="volvo">Play MP3</option>
                                                        <option value="saab">Saab</option>
                                                        <option value="opel">Opel</option>
                                                        <option value="audi">Audi</option>
                                                    </select>

                                                </div>
                                                <a id="option-1-sub-4-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit1Sub4()">Replace File</a>
                                                <input
                                                    id="option-1-sub-4-replace-file-input"
                                                    type="file"
                                                    name="option_6_replace_sub_1"
                                                    style="display:none"
                                                    class="replace-img"
                                                    accept="audio/mp3,audio/*;capture=microphone"
                                                    onchange="uploadFileDigit1Sub4()" />
                                            </div>

                                        </div>
                                        <div class="col-md-4 mt-5 ">
                                            <div class="d-flex justify-content-center align-items-center flex-column">
                                                <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                                                    <label for="">Function</label>
                                                    <select name="cars" id="cars" form="" class="play">
                                                        <option value="volvo">Play MP3</option>
                                                        <option value="saab">Saab</option>
                                                        <option value="opel">Opel</option>
                                                        <option value="audi">Audi</option>
                                                    </select>

                                                </div>
                                                <a id="option-1-sub-5-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit1Sub5()">Replace File</a>
                                                <input
                                                    id="option-1-sub-5-replace-file-input"
                                                    type="file"
                                                    name="option_6_replace_sub_1"
                                                    style="display:none"
                                                    class="replace-img"
                                                    accept="audio/mp3,audio/*;capture=microphone"
                                                    onchange="uploadFileDigit1Sub5()" />
                                            </div>

                                        </div>


                                        <div class="col-md-4 mt-5 ">
                                            <div class="d-flex justify-content-center align-items-center flex-column">
                                                <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                                                    <label for="">Function</label>
                                                    <select name="cars" id="cars" form="" class="play">
                                                        <option value="volvo">Play MP3</option>
                                                        <option value="saab">Saab</option>
                                                        <option value="opel">Opel</option>
                                                        <option value="audi">Audi</option>
                                                    </select>

                                                </div>
                                                <a id="option-1-sub-6-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit1Sub6()">Replace File</a>
                                                <input
                                                    id="option-1-sub-6-replace-file-input"
                                                    type="file"
                                                    name="option_6_replace_sub_6"
                                                    style="display:none"
                                                    class="replace-img"
                                                    accept="audio/mp3,audio/*;capture=microphone"
                                                    onchange="uploadFileDigit1Sub6()" />
                                            </div>

                                        </div>


                                        <div class="col-md-4 mt-5 ">
                                            <div class="d-flex justify-content-center align-items-center flex-column">
                                                <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                                                    <label for="">Function</label>
                                                    <select name="cars" id="cars" form="" class="play">
                                                        <option value="volvo">Play MP3</option>
                                                        <option value="saab">Saab</option>
                                                        <option value="opel">Opel</option>
                                                        <option value="audi">Audi</option>
                                                    </select>

                                                </div>
                                                <a id="option-1-sub-7-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit1Sub7()">Replace File</a>
                                                <input
                                                    id="option-1-sub-7-replace-file-input"
                                                    type="file"
                                                    name="option_6_replace_sub_7"
                                                    style="display:none"
                                                    class="replace-img"
                                                    accept="audio/mp3,audio/*;capture=microphone"
                                                    onchange="uploadFileDigit1Sub7()" />
                                            </div>

                                        </div>


                                        <div class="col-md-4 mt-5 ">
                                            <div class="d-flex justify-content-center align-items-center flex-column">
                                                <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                                                    <label for="">Function</label>
                                                    <select name="cars" id="cars" form="" class="play">
                                                        <option value="volvo">Play MP3</option>
                                                        <option value="saab">Saab</option>
                                                        <option value="opel">Opel</option>
                                                        <option value="audi">Audi</option>
                                                    </select>

                                                </div>
                                                <a id="option-1-sub-8-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit1Sub8()">Replace File</a>
                                                <input
                                                    id="option-1-sub-8-replace-file-input"
                                                    type="file"
                                                    name="option_6_replace_sub_8"
                                                    style="display:none"
                                                    class="replace-img"
                                                    accept="audio/mp3,audio/*;capture=microphone"
                                                    onchange="uploadFileDigit1Sub8()" />
                                            </div>

                                        </div>


                                        <div class="col-md-4 mt-5 ">
                                            <div class="d-flex justify-content-center align-items-center flex-column">
                                                <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                                                    <label for="">Function</label>
                                                    <select name="cars" id="cars" form="" class="play">
                                                        <option value="volvo">Play MP3</option>
                                                        <option value="saab">Saab</option>
                                                        <option value="opel">Opel</option>
                                                        <option value="audi">Audi</option>
                                                    </select>

                                                </div>
                                                <a id="option-1-sub-9-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit1Sub9()">Replace File</a>
                                                <input
                                                    id="option-1-sub-9-replace-file-input"
                                                    type="file"
                                                    name="option_6_replace_sub_9"
                                                    style="display:none"
                                                    class="replace-img"
                                                    accept="audio/mp3,audio/*;capture=microphone"
                                                    onchange="uploadFileDigit6Sub9()" />
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <script>
                        // Get the elements by their correct IDs
                        const replaceFileText = document.getElementById('replace-file-text');
                        const replaceFileInput = document.getElementById('replace-file-input');

                        // Add a click event to the link to trigger the file input
                        replaceFileText.addEventListener('click', () => {
                            replaceFileInput.click(); // Simulate a click on the hidden file input
                        });

                        // Add a change event to the file input to display the selected file name
                        replaceFileInput.addEventListener('change', (event) => {
                            const file = event.target.files[0];
                            replaceFileText.textContent = file ? file.name : 'No file chosen';
                        });
                    </script>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Understood</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const selectField = document.getElementById("cars");
            const mp3Section = document.getElementById("mp3-section");
            const transferSection = document.getElementById("transfer-section");
            const submenuSection = document.getElementById("submenu-section");


            const selectedFunction = "<?php echo $selectedFunction; ?>";

            if (selectedFunction == 'audio') {
                mp3Section.style.display = "block";
            }
            if (selectedFunction == 'transfer') {
                transferSection.style.display = "block";
            }

            if (selectedFunction == 'sub_menu') {
                submenuSection.style.display = "block";
            }

            function toggleSections() {
                const selectedValue = selectField.value;
                saveCurrentOption(selectedValue);
                mp3Section.style.display = selectedValue === "audio" ? "block" : "none";
                transferSection.style.display = selectedValue === "transfer" ? "block" : "none";
                submenuSection.style.display = selectedValue === "sub_menu" ? "block" : "none";
            }

            selectField.addEventListener("change", toggleSections);
        });


        function saveCurrentOption(selectedValue) {
            fetch("/update-call-action", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                    },
                    body: JSON.stringify({
                        type: selectedValue,
                        digit: 1
                    }) // Update based on digit 1
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        //  alert("File uploaded successfully.");
                    } else {
                        console.error("Update failed");
                        //  alert("Failed to upload the file.");
                    }
                })
                .catch(error => console.error("Error:", error));
        }

        function triggerFileInputForDigit2() {
            // Trigger file input click
            document.getElementById("option-2-replace-file-input").click();
        }


        function triggerFileInputForDigit1() {
            // Correct ID
            document.getElementById("option-1-replace-file-input").click();
        }

        function uploadFileDigit1() {
            const fileInput = document.getElementById("option-1-replace-file-input");
            const selectedFile = fileInput.files[0];
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if (selectedFile) {
                const formData = new FormData();
                formData.append("audio_file", selectedFile); // Append the selected file
                formData.append("type", "audio"); // Add any other required data
                formData.append("digit", 1); // Add any other required data

                fetch("{{ route('mp3-call-action.store') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": csrfToken, // Include CSRF token
                        },
                        body: formData, // Send the file and other data
                    })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.success) {
                            console.log("File uploaded successfully:", data);
                            alert("File uploaded successfully.");
                        } else {
                            console.error("Error uploading file:", data);
                            alert("Failed to upload the file.");
                        }
                    })
                    .catch((error) => {
                        console.error("Error:", error);
                        alert("An unexpected error occurred.");
                    });
            } else {
                alert("No file selected.");
            }
        }


        function uploadFileDigit2() {
            const fileInput = document.getElementById("option-2-replace-file-input");
            const selectedFile = fileInput.files[0];
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if (selectedFile) {
                const formData = new FormData();
                formData.append("audio_file", selectedFile); // Append the selected file
                formData.append("type", "audio"); // Add any other required data
                formData.append("digit", 2); // Add any other required data

                fetch("{{ route('mp3-call-action.store') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": csrfToken, // Include CSRF token
                        },
                        body: formData, // Send the file and other data
                    })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.success) {
                            console.log("File uploaded successfully:", data);
                            alert("File uploaded successfully.");
                        } else {
                            console.error("Error uploading file:", data);
                            alert("Failed to upload the file.");
                        }
                    })
                    .catch((error) => {
                        console.error("Error:", error);
                        alert("An unexpected error occurred.");
                    });
            } else {
                alert("No file selected.");
            }
        }


        function triggerFileInputForDigit3() {
            // Trigger file input click
            document.getElementById("option-3-replace-file-input").click();
        }

        function triggerFileInputForDigit1SubMenu() {
            // Trigger file input click
            document.getElementById("option-1-sub-menu-replace-file-input").click();
        }


        function triggerFileInputForDigit1Sub1() {
            // Trigger file input click
            document.getElementById("option-1-sub-1-replace-file-input").click();
        }

        function triggerFileInputForDigit1Sub2() {
            // Trigger file input click
            document.getElementById("option-1-sub-2-replace-file-input").click();
        }

        function triggerFileInputForDigit1Sub3() {
            // Trigger file input click
            document.getElementById("option-1-sub-3-replace-file-input").click();
        }

        function triggerFileInputForDigit1Sub4() {
            // Trigger file input click
            document.getElementById("option-1-sub-4-replace-file-input").click();
        }

        function triggerFileInputForDigit1Sub5() {
            // Trigger file input click
            document.getElementById("option-1-sub-5-replace-file-input").click();
        }

        function triggerFileInputForDigit1Sub6() {
            // Trigger file input click
            document.getElementById("option-1-sub-6-replace-file-input").click();
        }

        function triggerFileInputForDigit1Sub7() {
            // Trigger file input click
            document.getElementById("option-1-sub-7-replace-file-input").click();
        }

        function triggerFileInputForDigit1Sub8() {
            // Trigger file input click
            document.getElementById("option-1-sub-8-replace-file-input").click();
        }

        function triggerFileInputForDigit1Sub9() {
            // Trigger file input click
            document.getElementById("option-1-sub-9-replace-file-input").click();
        }

        function uploadFileDigit1Sub1() {
            const fileInput = document.getElementById("option-1-sub-1-replace-file-input");
            const selectedFile = fileInput.files[0];
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if (selectedFile) {
                const formData = new FormData();
                formData.append("audio_file", selectedFile); // Append the selected file
                formData.append("type", "audio"); // Add any other required data
                formData.append("digit", 1); // Add any other required data
                formData.append("sub", 1); // Add any other required data
                formData.append("sub_type", "audio");

                fetch("{{ route('mp3-call-action-sub.store') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": csrfToken, // Include CSRF token
                        },
                        body: formData, // Send the file and other data
                    })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.success) {
                            console.log("File uploaded successfully:", data);
                            alert("File uploaded successfully.");
                        } else {
                            console.error("Error uploading file:", data);
                            alert("Failed to upload the file.");
                        }
                    })
                    .catch((error) => {
                        console.error("Error:", error);
                        alert("An unexpected error occurred.");
                    });
            } else {
                alert("No file selected.");
            }
        }

        // function uploadFileDigit6Sub1() {
        //     const fileInput = document.getElementById("option-1-sub-1-replace-file-input");
        //     const selectedFile = fileInput.files[0];
        //     const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        //     if (selectedFile) {
        //         const formData = new FormData();
        //         formData.append("audio_file", selectedFile); // Append the selected file
        //         formData.append("type", "audio"); // Add any other required data
        //         formData.append("digit", 6); // Add any other required data
        //         formData.append("sub", 1); // Add any other required data

        //         fetch("{{ route('mp3-call-action-sub.store') }}", {
        //                 method: "POST",
        //                 headers: {
        //                     "X-CSRF-TOKEN": csrfToken, // Include CSRF token
        //                 },
        //                 body: formData, // Send the file and other data
        //             })
        //             .then((response) => response.json())
        //             .then((data) => {
        //                 if (data.success) {
        //                     console.log("File uploaded successfully:", data);
        //                     alert("File uploaded successfully.");
        //                 } else {
        //                     console.error("Error uploading file:", data);
        //                     alert("Failed to upload the file.");
        //                 }
        //             })
        //             .catch((error) => {
        //                 console.error("Error:", error);
        //                 alert("An unexpected error occurred.");
        //             });
        //     } else {
        //         alert("No file selected.");
        //     }
        // }

        function uploadFileDigit1Sub2() {
            const fileInput = document.getElementById("option-1-sub-2-replace-file-input");
            const selectedFile = fileInput.files[0];
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if (selectedFile) {
                const formData = new FormData();
                formData.append("audio_file", selectedFile); // Append the selected file
                formData.append("type", "audio"); // Add any other required data
                formData.append("digit", 1); // Add any other required data
                formData.append("sub", 2); // Add any other required data
                formData.append("sub_type", "audio");
                fetch("{{ route('mp3-call-action-sub.store') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": csrfToken, // Include CSRF token
                        },
                        body: formData, // Send the file and other data
                    })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.success) {
                            console.log("File uploaded successfully:", data);
                            alert("File uploaded successfully.");
                        } else {
                            console.error("Error uploading file:", data);
                            alert("Failed to upload the file.");
                        }
                    })
                    .catch((error) => {
                        console.error("Error:", error);
                        alert("An unexpected error occurred.");
                    });
            } else {
                alert("No file selected.");
            }
        }

        function uploadFileDigit1Sub3() {
            const fileInput = document.getElementById("option-1-sub-3-replace-file-input");
            const selectedFile = fileInput.files[0];
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if (selectedFile) {
                const formData = new FormData();
                formData.append("audio_file", selectedFile); // Append the selected file
                formData.append("type", "audio"); // Add any other required data
                formData.append("digit", 1); // Add any other required data
                formData.append("sub", 3); // Add any other required data
                formData.append("sub_type", "audio");
                fetch("{{ route('mp3-call-action-sub.store') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": csrfToken, // Include CSRF token
                        },
                        body: formData, // Send the file and other data
                    })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.success) {
                            console.log("File uploaded successfully:", data);
                            alert("File uploaded successfully.");
                        } else {
                            console.error("Error uploading file:", data);
                            alert("Failed to upload the file.");
                        }
                    })
                    .catch((error) => {
                        console.error("Error:", error);
                        alert("An unexpected error occurred.");
                    });
            } else {
                alert("No file selected.");
            }
        }

        function uploadFileDigit1Sub4() {
            const fileInput = document.getElementById("option-1-sub-4-replace-file-input");
            const selectedFile = fileInput.files[0];
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if (selectedFile) {
                const formData = new FormData();
                formData.append("audio_file", selectedFile); // Append the selected file
                formData.append("type", "audio"); // Add any other required data
                formData.append("digit", 1); // Add any other required data
                formData.append("sub", 4); // Add any other required data
                formData.append("sub_type", "audio");
                fetch("{{ route('mp3-call-action-sub.store') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": csrfToken, // Include CSRF token
                        },
                        body: formData, // Send the file and other data
                    })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.success) {
                            console.log("File uploaded successfully:", data);
                            alert("File uploaded successfully.");
                        } else {
                            console.error("Error uploading file:", data);
                            alert("Failed to upload the file.");
                        }
                    })
                    .catch((error) => {
                        console.error("Error:", error);
                        alert("An unexpected error occurred.");
                    });
            } else {
                alert("No file selected.");
            }
        }

        function uploadFileDigit1Sub5() {
            const fileInput = document.getElementById("option-1-sub-5-replace-file-input");
            const selectedFile = fileInput.files[0];
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if (selectedFile) {
                const formData = new FormData();
                formData.append("audio_file", selectedFile); // Append the selected file
                formData.append("type", "audio"); // Add any other required data
                formData.append("digit", 1); // Add any other required data
                formData.append("sub", 5); // Add any other required data
                formData.append("sub_type", "audio");
                fetch("{{ route('mp3-call-action-sub.store') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": csrfToken, // Include CSRF token
                        },
                        body: formData, // Send the file and other data
                    })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.success) {
                            console.log("File uploaded successfully:", data);
                            alert("File uploaded successfully.");
                        } else {
                            console.error("Error uploading file:", data);
                            alert("Failed to upload the file.");
                        }
                    })
                    .catch((error) => {
                        console.error("Error:", error);
                        alert("An unexpected error occurred.");
                    });
            } else {
                alert("No file selected.");
            }
        }

        function uploadFileDigit1Sub6() {
            const fileInput = document.getElementById("option-1-sub-6-replace-file-input");
            const selectedFile = fileInput.files[0];
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if (selectedFile) {
                const formData = new FormData();
                formData.append("audio_file", selectedFile); // Append the selected file
                formData.append("type", "audio"); // Add any other required data
                formData.append("digit", 6); // Add any other required data
                formData.append("sub", 1); // Add any other required data

                fetch("{{ route('mp3-call-action-sub.store') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": csrfToken, // Include CSRF token
                        },
                        body: formData, // Send the file and other data
                    })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.success) {
                            console.log("File uploaded successfully:", data);
                            alert("File uploaded successfully.");
                        } else {
                            console.error("Error uploading file:", data);
                            alert("Failed to upload the file.");
                        }
                    })
                    .catch((error) => {
                        console.error("Error:", error);
                        alert("An unexpected error occurred.");
                    });
            } else {
                alert("No file selected.");
            }
        }

        function uploadFileDigit1Sub7() {
            const fileInput = document.getElementById("option-1-sub-7-replace-file-input");
            const selectedFile = fileInput.files[0];
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if (selectedFile) {
                const formData = new FormData();
                formData.append("audio_file", selectedFile); // Append the selected file
                formData.append("type", "audio"); // Add any other required data
                formData.append("digit", 7); // Add any other required data
                formData.append("sub", 1); // Add any other required data

                fetch("{{ route('mp3-call-action-sub.store') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": csrfToken, // Include CSRF token
                        },
                        body: formData, // Send the file and other data
                    })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.success) {
                            console.log("File uploaded successfully:", data);
                            alert("File uploaded successfully.");
                        } else {
                            console.error("Error uploading file:", data);
                            alert("Failed to upload the file.");
                        }
                    })
                    .catch((error) => {
                        console.error("Error:", error);
                        alert("An unexpected error occurred.");
                    });
            } else {
                alert("No file selected.");
            }
        }

        function uploadFileDigit1Sub8() {
            const fileInput = document.getElementById("option-1-sub-8-replace-file-input");
            const selectedFile = fileInput.files[0];
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if (selectedFile) {
                const formData = new FormData();
                formData.append("audio_file", selectedFile); // Append the selected file
                formData.append("type", "audio"); // Add any other required data
                formData.append("digit", 1); // Add any other required data
                formData.append("sub", 8); // Add any other required data
                formData.append("sub_type", "audio");
                fetch("{{ route('mp3-call-action-sub.store') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": csrfToken, // Include CSRF token
                        },
                        body: formData, // Send the file and other data
                    })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.success) {
                            console.log("File uploaded successfully:", data);
                            alert("File uploaded successfully.");
                        } else {
                            console.error("Error uploading file:", data);
                            alert("Failed to upload the file.");
                        }
                    })
                    .catch((error) => {
                        console.error("Error:", error);
                        alert("An unexpected error occurred.");
                    });
            } else {
                alert("No file selected.");
            }
        }

        function uploadFileDigit6Sub9() {
            const fileInput = document.getElementById("option-1-sub-9-replace-file-input");
            const selectedFile = fileInput.files[0];
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if (selectedFile) {
                const formData = new FormData();
                formData.append("audio_file", selectedFile); // Append the selected file
                formData.append("type", "audio"); // Add any other required data
                formData.append("digit", 1); // Add any other required data
                formData.append("sub", 9); // Add any other required data
                formData.append("sub_type", "audio");
                fetch("{{ route('mp3-call-action-sub.store') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": csrfToken, // Include CSRF token
                        },
                        body: formData, // Send the file and other data
                    })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.success) {
                            console.log("File uploaded successfully:", data);
                            alert("File uploaded successfully.");
                        } else {
                            console.error("Error uploading file:", data);
                            alert("Failed to upload the file.");
                        }
                    })
                    .catch((error) => {
                        console.error("Error:", error);
                        alert("An unexpected error occurred.");
                    });
            } else {
                alert("No file selected.");
            }
        }


        function uploadFileDigit1SubMenu() {
            const fileInput = document.getElementById("option-1-sub-menu-replace-file-input");
            const selectedFile = fileInput.files[0];
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if (selectedFile) {
                const formData = new FormData();
                formData.append("audio_file", selectedFile); // Append the selected file
                formData.append("type", "sub_menu"); // Add any other required data
                formData.append("digit", 1); // Add any other required data
                formData.append("sub_type", 'greetings'); // Add any other required data
            //    formData.append("sub", 1); // Add any other required data

                fetch("{{ route('mp3-call-action-sub.store') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": csrfToken, // Include CSRF token
                        },
                        body: formData, // Send the file and other data
                    })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.success) {
                            console.log("File uploaded successfully:", data);
                            alert("File uploaded successfully.");
                        } else {
                            console.error("Error uploading file:", data);
                            alert("Failed to upload the file.");
                        }
                    })
                    .catch((error) => {
                        console.error("Error:", error);
                        alert("An unexpected error occurred.");
                    });
            } else {
                alert("No file selected.");
            }
        }

        function uploadFileDigit3() {
            const fileInput = document.getElementById("option-3-replace-file-input");
            const selectedFile = fileInput.files[0];
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if (selectedFile) {
                const formData = new FormData();
                formData.append("audio_file", selectedFile); // Append the selected file
                formData.append("type", "audio"); // Add any other required data
                formData.append("digit", 3); // Add any other required data

                fetch("{{ route('mp3-call-action.store') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": csrfToken, // Include CSRF token
                        },
                        body: formData, // Send the file and other data
                    })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.success) {
                            alert("File uploaded successfully.");
                        } else {
                            alert("Failed to upload the file.");
                        }
                    })
                    .catch((error) => {
                        console.error("Error:", error);
                        alert("An unexpected error occurred.");
                    });
            } else {
                alert("No file selected.");
            }
        }


        function triggerFileInputForDigit4() {
            // Trigger file input click
            document.getElementById("option-4-replace-file-input").click();
        }

        function uploadFileDigit4() {
            const fileInput = document.getElementById("option-4-replace-file-input");
            const selectedFile = fileInput.files[0];
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if (selectedFile) {
                const formData = new FormData();
                formData.append("audio_file", selectedFile); // Append the selected file
                formData.append("type", "audio"); // Add any other required data
                formData.append("digit", 4); // Add any other required data

                fetch("{{ route('mp3-call-action.store') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": csrfToken, // Include CSRF token
                        },
                        body: formData, // Send the file and other data
                    })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.success) {
                            console.log("File uploaded successfully:", data);
                            alert("File uploaded successfully.");
                        } else {
                            console.error("Error uploading file:", data);
                            alert("Failed to upload the file.");
                        }
                    })
                    .catch((error) => {
                        console.error("Error:", error);
                        alert("An unexpected error occurred.");
                    });
            } else {
                alert("No file selected.");
            }
        }





        function saveNumber(digit, afer) {
            const numberInput = document.getElementById('number-input').value;
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if (numberInput.trim() !== "") {
                fetch("{{ route('call-action.store') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": csrfToken,
                        },
                        body: JSON.stringify({
                            type: "transfer", // Replace with the actual type value
                            number: numberInput,
                            afer: afer, // Adjust as needed
                            digit: digit, // Adjust as needed
                        }),
                    })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.success) {
                            console.log("Data saved successfully:", data);
                            alert("Number saved successfully.");
                        } else {
                            console.error("Error saving data:", data);
                            alert("Failed to save the number.");
                        }
                    })
                    .catch((error) => {
                        console.error("Error:", error);
                        alert("An unexpected error occurred.");
                    });
            }
        }

        function saveNumber1() {
            const numberInput = document.getElementById('number-input-1').value;
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            if (numberInput.trim() !== "") {
                fetch("{{ route('call-action.store') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": csrfToken,
                        },
                        body: JSON.stringify({
                            type: "transfer", // Replace with the actual type value
                            number: numberInput,
                            afer: 60, // Adjust as needed
                            digit: 1, // Adjust as needed
                        }),
                    })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.success) {
                            console.log("Data saved successfully:", data);
                            alert("Number saved successfully.");
                        } else {
                            console.error("Error saving data:", data);
                            alert("Failed to save the number.");
                        }
                    })
                    .catch((error) => {
                        console.error("Error:", error);
                        alert("An unexpected error occurred.");
                    });
            }
        }


        function saveNumber9() {
            const numberInput = document.getElementById('number-input-9').value;
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            if (numberInput.trim() !== "") {
                fetch("{{ route('call-action.store') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": csrfToken,
                        },
                        body: JSON.stringify({
                            type: "transfer", // Replace with the actual type value
                            number: numberInput,
                            afer: 2, // Adjust as needed
                            digit: 9, // Adjust as needed
                        }),
                    })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.success) {
                            console.log("Data saved successfully:", data);
                            alert("Number saved successfully.");
                        } else {
                            console.error("Error saving data:", data);
                            alert("Failed to save the number.");
                        }
                    })
                    .catch((error) => {
                        console.error("Error:", error);
                        alert("An unexpected error occurred.");
                    });
            }
        }
    </script>


    <script>
        // Get the elements by their correct IDs
        const replaceFileText = document.getElementById('replace-file-text');
        const replaceFileInput = document.getElementById('replace-file-input');

        // Add a click event to the link to trigger the file input
        replaceFileText.addEventListener('click', () => {
            replaceFileInput.click(); // Simulate a click on the hidden file input
        });

        // Add a change event to the file input to display the selected file name
        replaceFileInput.addEventListener('change', (event) => {
            const file = event.target.files[0];
            replaceFileText.textContent = file ? file.name : 'No file chosen';
        });
    </script>

    <script>
        // Get the elements by their correct IDs
        const replaceFileNonSubText = document.getElementById('replace-file-non-sub-text');
        const replaceNonFileInput = document.getElementById('replace-non-file-input');

        // Add a click event to the link to trigger the file input
        replaceFileNonSubText.addEventListener('click', () => {
            replaceNonFileInput.click(); // Simulate a click on the hidden file input
        });

        // Add a change event to the file input to display the selected file name
        replaceNonFileInput.addEventListener('change', (event) => {
            const file = event.target.files[0];
            replaceFileText.textContent = file ? file.name : 'No file chosen';
        });
    </script>

    {{-- option 1 --}}
    <script>
        // Get the elements by their correct IDs
        const transferReplaceFileText = document.getElementById('transfer-replace-file-text');
        const transferReplaceFileInput = document.getElementById('transfer-replace-file-input');

        // Add a click event to the link to trigger the file input
        transferReplaceFileText.addEventListener('click', () => {
            transferReplaceFileInput.click(); // Simulate a click on the hidden file input
        });

        // Add a change event to the file input to display the selected file name
        transferReplaceFileInput.addEventListener('change', (event) => {
            const file = event.target.files[0];
            replaceFileText.textContent = file ? file.name : 'No file chosen';
        });
    </script>


    {{-- option 2 --}}
    <!-- <script>
        // Get the elements by their correct IDs
        const optionTwoReplaceFileText = document.getElementById('option-2-replace-file-text');
        const optionTwoReplaceFileInput = document.getElementById('option-2-replace-file-input');

        // Add a click event to the link to trigger the file input
        optionTwoReplaceFileText.addEventListener('click', () => {
            optionTwoReplaceFileInput.click(); // Simulate a click on the hidden file input
        });

        // Add a change event to the file input to display the selected file name
        optionTwoReplaceFileInput.addEventListener('change', (event) => {
            const file = event.target.files[0];
            optionTwoReplaceFileText.textContent = file ? file.name : 'No file chosen';
        });
    </script> -->

    {{-- option 3 --}}
    <script>
        // Get the elements by their correct IDs
        // const optionThreeReplaceFileText = document.getElementById('option-3-replace-file-text');
        // const optionThreeReplaceFileInput = document.getElementById('option-3-replace-file-input');

        // // Add a click event to the link to trigger the file input
        // optionThreeReplaceFileText.addEventListener('click', () => {
        //     optionThreeReplaceFileInput.click(); // Simulate a click on the hidden file input
        // });

        // // Add a change event to the file input to display the selected file name
        // optionThreeReplaceFileInput.addEventListener('change', (event) => {
        //     const file = event.target.files[0];
        //     optionThreeReplaceFileText.textContent = file ? file.name : 'No file chosen';
        // });
    </script>

    {{-- option 4 --}}
    <script>
        // Get the elements by their correct IDs
        // const optionFourReplaceFileText = document.getElementById('option-4-replace-file-text');
        // const optionFourReplaceFileInput = document.getElementById('option-4-replace-file-input');

        // // Add a click event to the link to trigger the file input
        // optionFourReplaceFileText.addEventListener('click', () => {
        //     optionFourReplaceFileInput.click(); // Simulate a click on the hidden file input
        // });

        // // Add a change event to the file input to display the selected file name
        // optionFourReplaceFileInput.addEventListener('change', (event) => {
        //     const file = event.target.files[0];
        //     optionFourReplaceFileText.textContent = file ? file.name : 'No file chosen';
        // });
    </script>



</x-app-layout>
