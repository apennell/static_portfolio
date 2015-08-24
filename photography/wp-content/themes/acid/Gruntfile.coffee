DIR = 
	images: "assets/images"
	sass: "assets/sass"
	bower: "assets/bower"
	js: "assets/js"
	app:
		coffee: "assets/js/coffee"
		js: "assets/js/coffee-compiled"


module.exports = (grunt) ->

	grunt.initConfig 
		pkg: grunt.file.readJSON('package.json')

		###
			COMPASS
		###
		compass:
			default:
				options:
					sassDir: DIR.sass
					cssDir: "css"
					imagesDir: DIR.images
					require: ["sass-globbing"]
					debugInfo: false
					noLineComments: false
					relativeAssets: true
					outputStyle: 'nested'
		###
			CoffeeScript
		###
		coffee:
			default:
				options:
					bare: false
					sourceMap: false
					join: true
				expand: true
				files: "js/app.js": "#{DIR.app.coffee}/*.coffee"

			production:
				expand: true
				cwd: DIR.app.coffee
				dest: DIR.app.js
				src: ["*.coffee"]
				ext: ".js"
				options:
					bare: false
					sourceMap: false

			production_app:
				options:
					bare: false
					sourceMap: false
					join: true
				expand: true
				files: "js/app.raw.js": "#{DIR.app.coffee}/*.coffee"	
		###
			Concatenate & Uglify
		###
		uglify:
			default:
				options:
					beautify: true
					compress: false
					mangle: false
					preserveComments: 'all'
				files: 
					"js/libs.js": "#{DIR.js}/libs/*.js"
			
			production:
				options:
					beautify: false
					compress: true
					mangle:
						except: ["jQuery", "window"]
					report: 'min'
					preserveComments: false
				files: [
					"js/app.js": "js/app.raw.js"
					"js/libs.js": "#{DIR.js}/libs/*.js"
				]
					# "js/admin.js": "#{DIR.js}/admin.js/*.js"
		# concat:
		# 	default:
		# 		src: [
		# 			"#{DIR.bower}/superfish/dist/js/superfish.js",
		# 			"#{DIR.bower}/packery/js/item.js",
		# 			]
		# 		dest: "#{DIR.js}/libs/bower_manual.js"
		# bower:
		# 	default:
		# 		dest: "#{DIR.js}/libs/bower.js"
		# 		exclude: ["jquery", "superfish", "modernizr"]
		clean:
			always:
				src: ["#{DIR.js}/libs/bower.js", "#{DIR.js}/libs/bower_manual.js"]
			production:
				src: ["js/*", "#{DIR.app.js}/*"]
				filter: 'isFile'

		###
			Watch & Live Reload
		###
		watch:
			coffeescript:
				files: "#{DIR.app.coffee}/*.coffee"
				tasks: ["coffee:default"]
			

			javascript:
				files: "assets/**/*.js"
				tasks: ["clean:always", "concat", "bower", "uglify:default"]
			
			compass:
				files: ["#{DIR.sass}/**/*.{scss,sass}", "#{DIR.sass}/**/**/*.sass"],
				tasks: ["compass:default"]
			
			livereload:
				files: ["js/*.js", "**/*.php", "css/*.css", "images/**/*.{png,jpg,jpeg,gif,webp,svg}"]
				options:
					livereload: true
			
		jshint:
			default:
				src: ["#{DIR.app.js}/*.js"]
				options:
					eqnull: true
					shadow: true
					jquery: true
					"-W099": true # Mixed Spaces & Tabs

					globals:
						jQuery: true
						App: true
						global: true

		cssmin:
			minify:
				keepSpecialComments: 0
				expand: true,
				cwd: 'css/',
				src: ['*.css', '!*.min.css'],
				dest: 'css/',
				ext: '.min.css'

		#
		# Compress Images
		#
		
		img:
			compress:
				src: "assets/images/*.png"
	
	# Load Tasks:
	grunt.loadNpmTasks 'grunt-contrib-watch'
	grunt.loadNpmTasks 'grunt-contrib-cssmin'
	grunt.loadNpmTasks 'grunt-contrib-compass'
	grunt.loadNpmTasks 'grunt-contrib-coffee'
	grunt.loadNpmTasks 'grunt-contrib-concat'
	grunt.loadNpmTasks 'grunt-contrib-jshint'
	grunt.loadNpmTasks 'grunt-contrib-uglify'
	grunt.loadNpmTasks 'grunt-contrib-clean'
	grunt.loadNpmTasks 'grunt-bower-concat'
	grunt.loadNpmTasks 'grunt-img'




	# Register Tasks:
	grunt.registerTask 'icons', ["compass:icons", "img:compress"]
	grunt.registerTask 'hint', ["clean:production", "coffee:production", "jshint:default"]
	grunt.registerTask 'default', [ 
									'clean:always',
									'coffee:default',
									# 'bower:default',
									# 'concat:default',
									'uglify:default',
									'compass:default'
									'jshint:default'
									]
	grunt.registerTask 'production', [ 
									'clean',
									'coffee:production',
									'coffee:production_app',
									# 'bower:default',
									# 'concat:default',
									'uglify:production',
									'compass',
									'cssmin'
									]




