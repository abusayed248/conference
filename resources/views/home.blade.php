<x-app-layout>
    <div class="mt-5">
        <div class="container">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="row sub-menu" id="call-subcall-action">
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
                        <div v-if="isLoading" class="text-center mt-3">
                            <p>Loading call actions...</p>
                        </div>
                        <div v-else class="col-md-4 mt-3" v-for="(callAction, index) in callActions" :key="index">

                            <div class="d-flex justify-content-center align-items-center flex-column">
                                <h1 style="font-size: 40px !important;">@{{ callAction.digit }}</h1>
                                <div class="d-flex align-items-center mt-2 ">
                                    <select v-model="callAction.selectedFunction" class="play form-select w-100" @change="saveCurrentOption(index)">
                                        <option value="none">None</option>
                                        <option value="audio">Play MP3</option>
                                        <option value="transfer">Transfer</option>
                                        <option value="sub_menu">Submenu</option>
                                    </select>
                                </div>

                                <!-- Audio Upload -->
                                <div v-if="callAction.selectedFunction == 'audio'" class="col-md-12">
                                    <div class="d-flex align-items-center flex-column">
                                        <template v-if="callAction.audio_link">
                                            <a class="text-decoration" href="javascript:void(0)" @click="triggerFileInput(index)">Replace</a>
                                            <a class="text-decoration" :href="callAction.audio_link" target="_blank">View</a>
                                        </template>

                                        <!-- If no audio file, show Upload -->
                                        <template v-else>
                                            <a class="text-decoration" href="javascript:void(0)" @click="triggerFileInput(index)">Upload</a>
                                        </template>
                                        <input type="file" :id="'file-input-' + index" style="display:none" accept="audio/mp3,audio/*;capture=microphone" @change="uploadFile(index, $event)" />
                                    </div>
                                </div>

                                <!-- Transfer Inputs -->
                                <div v-if="callAction.selectedFunction == 'transfer'" class="col-md-12">
                                    <div class="d-flex justify-content-center align-items-center flex-column">
                                        <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                                            <label>To</label>
                                            <input type="text" v-model="callAction.transferNumber" class="w-100" placeholder="+1123355656" @blur="saveTransfer(index)" />
                                        </div>
                                        <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                                            <label>Enter after (minutes)</label>
                                            <input type="number" v-model="callAction.transferAfterTime" class="w-100" placeholder="60" @blur="saveTransfer(index)" />
                                        </div>
                                    </div>
                                </div>




                                <!-- Submenu Popup -->
                                <div v-if="callAction.selectedFunction == 'sub_menu'" class="col-md-12">
                                    <div class="d-flex align-items-center flex-column">
                                        <a class="text-decoration" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#submenuModal" @click="openSubmenu(index)">Edit Submenu</a>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>


                <!-- Submenu Modal -->
                <div class="modal fade" id="submenuModal" tabindex="-1" aria-labelledby="submenuModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="submenuModalLabel">Edit Submenu - Digit @{{ selectedSubmenuDigit }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>



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

                                                    <a id="option-1-sub-1-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" @click="triggerGreetingSubmenuFileInput(selectedSubmenuDigit)">Replace</a>

                                                    <input
                                                        :id="'submenu-greeting-file-input-' + selectedSubmenuDigit"
                                                        type="file"
                                                        name="option_6_replace"
                                                        style="display:none"
                                                        class="replace-img"
                                                        accept="audio/mp3,audio/*;capture=microphone"
                                                        @change="uploadGreetingFileSubMenu(selectedSubmenuDigit,$event)" />
                                                </div>

                                            </div>





                                            <div class="col-md-8 py-5 bg-green-600">
                                                <div class="row">
                                                    <div class="col-md-4 mt-3" v-for="(subaction, subIndex) in subactions" :key="subIndex">
                                                        <div class="d-flex align-items-center flex-column">
                                                            <p class="fw-bold">@{{ subIndex + 1 }}</p>
                                                            <div class="d-flex align-items-center mt-2 w-100">
                                                                <label for="">Function</label>
                                                                <select name="cars" id="cars" form="" class="play">
                                                                    <option value="volvo">Play MP3</option>
                                                                </select>
                                                            </div>


                                                            <template v-if="subaction.audio_link">

                                                                <a id="option-1-sub-1-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" @click="triggerSubmenuFileInput(subIndex)">Replace</a>


                                                                <a class="text-decoration" :href="subaction.audio_link" target="_blank">View</a>
                                                            </template>

                                                            <!-- If no audio file, show Upload -->
                                                            <template v-else>
                                                                <a class="text-decoration" href="javascript:void(0)" @click="triggerSubmenuFileInput(subIndex)">Upload</a>
                                                            </template>
                                                            <input type="file" :id="'submenu-file-input-' + subIndex" class="replace-img" style="display:none" accept="audio/mp3,audio/*;capture=microphone" @change="uploadSubmenuFile(subIndex, $event)" />
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

        <script>
            new Vue({
                el: '#call-subcall-action',
                data: {
                    callActions: [],
                    selectedSubmenuDigit: null,
                    subactions: [],
                    lastTransferData: {},
                    isLoading: true
                },
                methods: {
                    // Fetch existing call actions from API
                    fetchCallActions() {
                        axios.get('/all-call-action')
                            .then(response => {
                                this.callActions = response.data.map(action => ({
                                    ...action,
                                    selectedFunction: action.type || 'none',
                                    transferNumber: action.transfer_to || '',
                                    transferAfterTime: action.afer_time || '',
                                    audio_link: action.audio_link || '',
                                }));
                            })
                            .catch(error => {
                                console.error('Error fetching call actions:', error);
                            })
                            .finally(() => {
                                this.isLoading = false; // Stop loading
                            });
                    },


                    openSubmenu(index) {
                        this.selectedSubmenuDigit = index + 1;
                        this.fetchSubactions(this.selectedSubmenuDigit);
                    },

                    fetchSubactions(digit) {
                        axios.get(`/subactions/${digit}`)
                            .then(response => {
                                this.subactions = response.data.subactions;
                            })
                            .catch(error => console.error("Error fetching subactions:", error));
                    },

                    triggerSubmenuFileInput(subIndex) {
                        const fileInput = document.getElementById(`submenu-file-input-${subIndex}`);
                        if (fileInput) {
                            fileInput.value = ''; // Clear the input field
                        }

                        fileInput.click(); // Open file dialog
                    },

                    triggerGreetingSubmenuFileInput(subIndex) {
                        const fileInput = document.getElementById(`submenu-greeting-file-input-${subIndex}`);
                        if (fileInput) {
                            fileInput.value = ''; // Clear the input field
                        }
                        fileInput.click(); // Open file dialog
                    },

                    uploadSubmenuFile(subIndex, event) {
                        const file = event.target.files[0];
                        if (!file) return;

                        let formData = new FormData();
                        formData.append('audio_file', file);
                        formData.append('digit', this.selectedSubmenuDigit);
                        formData.append("type", "audio");
                        formData.append('sub', subIndex + 1);
                        formData.append("sub_type", "audio");

                        axios.post("/save-mp3-sub-call-action", formData)
                            .then(response => {
                                file.value = '';

                                this.fetchSubactions(this.selectedSubmenuDigit);
                                alert("Sub call action audio uploaded successfully.");
                            })
                            .catch(error => console.error("Error uploading audio:", error));
                    },

                    uploadGreetingFileSubMenu(selectedSubmenuDigit, event) {
                        const file = event.target.files[0];
                        if (!file) return;
                        let formData = new FormData();
                        formData.append('audio_file', file);
                        formData.append("type", "sub_menu");
                        formData.append("digit", selectedSubmenuDigit);
                        formData.append("sub_type", "greetings");

                        axios.post("/save-mp3-sub-call-action", formData)
                            .then(response => {
                                alert("Subaction audio uploaded successfully.");
                            })
                            .catch(error => console.error("Error uploading audio:", error));
                    },

                    // Save selected option dynamically
                    saveCurrentOption(index) {
                        let action = this.callActions[index];
                        axios.post("update-call-action", {
                                type: action.selectedFunction,
                                digit: index + 1
                            })
                            .then(response => {

                                console.log("Option saved successfully:");
                            })
                            .catch(error => console.error("Error saving option:", error));
                    },

                    // Save transfer details dynamically
                    saveTransfer(index) {
                        let action = this.callActions[index];

                        // Check if data is unchanged
                        if (
                            this.lastTransferData[index] &&
                            this.lastTransferData[index].number === action.transferNumber &&
                            this.lastTransferData[index].after_time === action.transferAfterTime
                        ) {
                            return; // Prevent unnecessary API calls
                        }

                        // Store last saved data to prevent duplicate calls
                        this.lastTransferData[index] = {
                            number: action.transferNumber,
                            after_time: action.transferAfterTime
                        };

                        axios.post("save-call-action", {
                                type: "transfer",
                                number: action.transferNumber,
                                afer_time: action.transferAfterTime,
                                digit: index + 1
                            })
                            .then(response => {
                                alert("Transfer details saved successfully.");
                            })
                            .catch(error => {
                                console.error("Error:", error);
                                alert("Failed to save transfer details.");
                            });
                    },

                    // Trigger file input for uploading
                    triggerFileInput(index) {
                        const fileInput = document.getElementById(`file-input-${index}`);

                        if (fileInput) {
                            fileInput.value = ''; // Clear the input field
                        }

                        fileInput.click(); // Open file dialog


                    },

                    // Upload file dynamically
                    uploadFile(index, event) {
                        const file = event.target.files[0];
                        if (!file) return;

                        let formData = new FormData();
                        formData.append('audio_file', file);
                        formData.append('type', 'audio');
                        formData.append('digit', index + 1);

                        axios.post("save-mp3-call-action", formData, {
                                headers: {
                                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                }
                            })
                            .then(response => {
                                if (response.data.success) {
                                    this.fetchCallActions();
                                    alert("File uploaded successfully.");
                                } else {
                                    alert("Failed to upload the file.");
                                }

                            })
                            .catch(error => {
                                console.error("Error:", error);
                                alert("An unexpected error occurred.");
                            });
                    }
                },

                mounted() {
                    this.fetchCallActions();
                }
            });
        </script>
</x-app-layout>
