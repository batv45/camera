<template>
    <ul v-if="links.length > 3" class="pagination m-0 ml-auto">
        <li v-for="(link, key) in links" class="page-item"
            :class="{'active': link.active,'disabled':link.url === null}">
            <div v-if="link.url === null" class="page-link"  :key="key"
                 v-html="link.label">
            </div>
            <inertia-link v-else :key="key" class="page-link"  :href="link.url"
                  v-html="link.label">
            </inertia-link>
        </li>
    </ul>
</template>

<script>
export default {
  props: {
    links: Array,
  },
}
</script>
