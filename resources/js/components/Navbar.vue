<script setup>

</script>

<template>
    <nav class="navbar navbar-expand-lg bg-dark border-bottom border-body" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Inventory App</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse tex" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <RouterLink :to="{name: 'CarList'}" class="nav-link">
                            Car list
                        </RouterLink>
                    </li>
                    <li class="nav-item">
                        <RouterLink :to="{name: 'CarCreate'}" class="nav-link">
                            Create car
                        </RouterLink>
                    </li>
                    <li class="nav-item">
                        <RouterLink :to="{name: 'CarArchive'}" class="nav-link">
                            Car archive
                        </RouterLink>
                    </li>
                    <li class="nav-item">
                        <RouterLink :to="{name: 'PartList'}" class="nav-link">
                            Part list
                        </RouterLink>
                    </li>
                    <li class="nav-item">
                        <RouterLink :to="{name: 'PartCreate'}" class="nav-link">
                            Create part
                        </RouterLink>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<style scoped>

</style>
