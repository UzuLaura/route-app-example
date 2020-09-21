<template>
    <div class="position-fixed fixed-top vh-100 vw-100 pt-5"
         style="background-color: rgba(0, 0, 0, 0.5);">
        <div class="modal-mask">
            <div class="modal-wrapper">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!--Modal Header-->
                        <div class="modal-header">

                            <!--Title-->
                            <h5 class="modal-title">{{ title }}</h5>
                            <!--Title-->

                            <!--Close Button-->
                            <button type="button"
                                    class="close"
                                    @click="$emit('close')">
                                <span>&times;</span>
                            </button>
                            <!--Close Button-->

                        </div>
                        <!--Modal Header-->

                        <!--Modal Body-->
                        <div class="modal-body">
                            <p><slot></slot></p>
                        </div>
                        <!--Modal Body-->

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['title'],
    }
</script>