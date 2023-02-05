<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { useForm, Head,  Link} from '@inertiajs/vue3';

const form = useForm({
    _method: 'POST',
    website: '',
    about: '',
    cover_photo: null,
    first_name: '',
    last_name: '',
    country: '',
    address: '',
});

const photoPreview = ref(null);
const photoInput = ref(null);

const selectNewPhoto = () => {
    photoInput.value.click();
};

const updatePhotoPreview = () => {
    const photo = photoInput.value.files[0];

    if (! photo) return;

    const reader = new FileReader();

    reader.onload = (e) => {
        photoPreview.value = e.target.result;
    };

    reader.readAsDataURL(photo);
};

const clearPhotoFileInput = () => {
    if (photoInput.value?.value) {
        photoInput.value.value = null;
    }
};

</script>

<template>
    <Head title="Students" />

    <AuthenticatedLayout>

        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Students</h2>

                <Link :href="route('students.index')">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Go back
                    </button>
                </Link>
            </div>
         
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <form @submit.prevent="form.post(route('students.store'), { onSuccess: () => form.reset() })">
                <div>
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Profile</h3>
                        <p class="mt-1 text-sm text-gray-600">This information will be displayed publicly so be careful what you share.</p>
                    </div>
                    </div>
                    <div class="mt-5 md:col-span-2 md:mt-0">
                    
                        <div class="shadow sm:overflow-hidden sm:rounded-md">
                        <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                            <div class="grid grid-cols-3 gap-6">
                            <div class="col-span-3 sm:col-span-2">
                                <label for="website" class="block text-sm font-medium text-gray-700">Website</label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                <span class="inline-flex items-center rounded-l-md border border-r-0 border-gray-300 bg-gray-50 px-3 text-sm text-gray-500">http://</span>
                                <input type="text" id="website" v-model="form.website" class="block w-full flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="www.example.com">
                                </div>
                                <InputError :message="form.errors.website" class="mt-2" />
                            </div>
                            </div>

                            <div>
                            <label for="about" class="block text-sm font-medium text-gray-700">About</label>
                            <div class="mt-1">
                                <textarea id="about" v-model="form.about" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="you@example.com"></textarea>
                            </div>
                            <p class="mt-2 text-sm text-gray-500">Brief description for your profile. URLs are hyperlinked.</p>
                            <InputError :message="form.errors.about" class="mt-2" />
                            </div>

                            <div>
                            <label class="block text-sm font-medium text-gray-700">Cover photo</label>
                            <div class="mt-1 flex justify-center rounded-md border-2 border-dashed border-gray-300 px-6 pt-5 pb-6">
                                <div class="space-y-1 text-center">

                                <input
                                    ref="photoInput"
                                    type="file"
                                    class="hidden" 
                                    @input="form.cover_photo = $event.target.files[0]"
                                    @change="updatePhotoPreview"
                                >

                                <!-- Current Profile Photo -->
                                <div v-show="! photoPreview" class="mt-2" @click.prevent="selectNewPhoto">
                                    <img :src="'/img/cover-img.svg'" alt="test" class="h-44 pb-4 mx-auto">
                                </div>

                                <!-- New Profile Photo Preview -->
                                <div v-show="photoPreview" class="mt-2" @click.prevent="selectNewPhoto">
                                    <span
                                        class="block h-44 bg-cover bg-no-repeat bg-center  pb-4"
                                        :style="'background-image: url(\'' + photoPreview + '\');'"
                                    />
                                </div>

                                <SecondaryButton class="mt-2 mr-2" type="button" @click.prevent="selectNewPhoto">
                                    Select A New Photo
                                </SecondaryButton>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                                </div>
                            </div>
                            </div>
                        </div>
                     
                        </div>
                    </div>
                </div>
                </div>

                <div class="hidden sm:block" aria-hidden="true">
                <div class="py-5">
                    <div class="border-t border-gray-200"></div>
                </div>
                </div>

                <div class="mt-10 sm:mt-0">
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Personal Information</h3>
                        <p class="mt-1 text-sm text-gray-600">Use a permanent address where you can receive mail.</p>
                    </div>
                    </div>
                    <div class="mt-5 md:col-span-2 md:mt-0">
                        <div class="overflow-hidden shadow sm:rounded-md">
                        <div class="bg-white px-4 py-5 sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3">
                                <label for="first-name" class="block text-sm font-medium text-gray-700">First name</label>
                                <input type="text" name="first-name" id="first-name" autocomplete="given-name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="last-name" class="block text-sm font-medium text-gray-700">Last name</label>
                                <input type="text" name="last-name" id="last-name" autocomplete="family-name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
                                <select id="country" name="country" autocomplete="country-name" class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                <option>United States</option>
                                <option>Canada</option>
                                <option>Mexico</option>
                                </select>
                            </div>

                            <div class="col-span-6">
                                <label for="street-address" class="block text-sm font-medium text-gray-700">Street address</label>
                                <input type="text" name="street-address" id="street-address" autocomplete="street-address" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>
                 
                            </div>
                        </div>

                        <div class="float-right px-4 pb-4"> 
                            <PrimaryButton class="mt-4">Submit</PrimaryButton>
                        </div>

                        </div>
                    </div>
                </div>
                </div>
                </form>

            </div>
        </div>
        
    </AuthenticatedLayout>
</template>
