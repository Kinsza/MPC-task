import Swiper, { Pagination } from 'swiper'
// import Swiper and modules styles
import 'swiper/css'
import 'swiper/css/navigation'
import 'swiper/css/pagination'
import 'swiper/css/thumbs'

let swiper = new Swiper('.mySwiper', {
	modules: [Pagination],
	slidesPerView: 2,
	spaceBetween: 10,
	pagination: {
		el: '.swiper-pagination',
	},
	paginationClickable: true,
	mousewheel: true,
	keyboard: true,
	breakpoints: {
		768: {
			slidesPerView: 3,
			spaceBetween: 20,
		},
		1024: {
			slidesPerView: 4,
			spaceBetween: 30,
		},
		1280: {
			slidesPerView: 4,
			spaceBetween: 30,
		},
		1440: {
			slidesPerView: 5,
			spaceBetween: 30,
		},
	},
})

let swiper2 = new Swiper('.mySwiper2', {
	modules: [Pagination],
	slidesPerView: 2,
	spaceBetween: 10,
	pagination: {
		el: '.swiper-pagination2',
	},
	paginationClickable: true,
	mousewheel: true,
	keyboard: true,
	breakpoints: {
		768: {
			slidesPerView: 3,
			spaceBetween: 20,
		},
		1024: {
			slidesPerView: 4,
			spaceBetween: 30,
		},
		1280: {
			slidesPerView: 4,
			spaceBetween: 30,
		},
		1440: {
			slidesPerView: 5,
			spaceBetween: 30,
		},
	},
})
