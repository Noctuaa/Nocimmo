<template>
<div class="row justify-content-center">
    <div class="m-auto">
            <input type="file" class="inputfile" accept="image/*" @change="handleSelects" :id="name" :name="name">
            <label style="width:112px" :for="name" :class="{error, 'lds-hourglass' : loading}" class="form-control btn btn-block bg-gradient-primary">{{loading ? '' : 'Choisir'}}</label>
            <span v-if="error" class="invalid-feedback text-center" role="alert">
                <strong>{{message}}</strong>
            </span>
        </div>

        <div class="row d-flex justify-content-sm-center">
            <div class="mb-2 mt-2" :class="multiple ? 'col-12 col-xl-3 col-sm-6' : 'col-12 col-md-12'"
                v-for="(image, index) in images" :key="index">
                <img :src="'/' + image" class="img-fluid">
                <div class="delete-image d-flex justify-content-center align-items-center"
                    v-on:click.prevent="deleteImage(index)" v-if="edit && multiple">
                    <font-awesome-icon class="fa-times" icon="times" />
                </div>
            </div>
            <div class="mb-2 mt-2" :class="multiple ? 'col-12 col-xl-3 col-sm-6' : 'col-12 col-md-12'" v-for="prev in preview" :key="prev">
                <img :src="prev" class="img-fluid">
            </div>
        </div>
    </div>
</template>


<script>
    export default {
        props: {
            multiple: Boolean,
            name: String,
            image: Array,
            edit: Boolean,
            error: String,
            message: String,
            realestate: null
        },
        data() {
            return {
                images: [],
                fileList: [],
                preview: [],
                loading: false
            }
        },
        methods: {
            /**
             * Preview an image
             * @param {object} e
             */
            handleSelects(e) {
                this.loading = true;
                this.preview = [];
                this.fileList = Array.prototype.slice.call(e.target.files);
                this.fileList.forEach(f => {
                    if (!f.type.match("image/jpeg|image/png|image/jpg")) {
                        return;
                    }

                    let reader = new FileReader();
                    reader.onload = (e) => {
                        if (!this.multiple && this.edit) {
                            this.images = [];
                        }
                        this.preview.push(e.target.result);
                    };
                    reader.readAsDataURL(f);
                    this.loading = false;
                });
            },

            /**
             * Send the real estate id with the image and its extension.
             * @param {number} n
             */
            async deleteImage(n) {
                try {
                    this.loading = true;
                    const image = this.images[n].substr(this.images[n].lastIndexOf('/') + 1, (this.images[n]
                        .lastIndexOf('.') - this.images[n].lastIndexOf('/') - 1));
                    const ext = this.images[n].substr(this.images[n].lastIndexOf('.') + 1);
                    const response = await axios.post('/dashboard/property/' + this.realestate + '/' + image + '/' +
                        ext + '/delete')
                    await this.images.splice(n, 1);
                    this.loading = false;

                } catch (error) {
                    console.log(error);
                }
            },

            /**
             * Define the multiple attribute and his name input
             */
            setAttrMultiple() {
                if (this.multiple) {
                    const input = document.querySelector('#' + this.name);
                    input.setAttribute("multiple", true)
                    input.setAttribute("name", this.name + '[]');
                }
            }
        },
        mounted() {
            if (this.edit) {
                this.images = this.image;
            }
            this.setAttrMultiple();
        }
    }

</script>

<style>
    .inputfile {
        width: 0.1px;
        height: 0.1px;
        opacity: 0;
        overflow: hidden;
        position: absolute;
        z-index: -1;
    }

    .delete-image {
        position: absolute;
        top: 0px;
        right: 5px;
        background-color: white;
        height: 22px;
        width: 25px;
        border-radius: 0px 0px 0px 10px;
        cursor: pointer;
    }

    .fa-times {
        transition: .3s;
        transform: rotate(0deg);
    }

    .delete-image:hover .fa-times {
        transform: rotate(90deg);
        transition: .3s;
    }

    .lds-hourglass:after {
        content: " ";
        position: relative;
        display: block;
        border-radius: 50%;
        width: 0;
        bottom: 7px;
        left: 25px;
        height: 0;
        margin: 0px;
        box-sizing: border-box;
        border: 19px solid #fff;
        border-color: #fff transparent #fff transparent;
        animation: lds-hourglass 1.2s infinite;
    }

    @keyframes lds-hourglass {
        0% {
            transform: rotate(0);
            animation-timing-function: cubic-bezier(0.55, 0.055, 0.675, 0.19);
        }

        50% {
            transform: rotate(900deg);
            animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
        }

        100% {
            transform: rotate(1800deg);
        }
    }

</style>
