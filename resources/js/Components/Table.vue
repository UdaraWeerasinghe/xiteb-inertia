<template>
        <table class="table-auto w-full bg-purple-900 rounded-lg">
            <thead  class="text-white">
                <slot name="thead"/>
            </thead>
            <tbody class="bg-white">
                <slot name="tbody"></slot>
            </tbody>
        </table>
</template>
