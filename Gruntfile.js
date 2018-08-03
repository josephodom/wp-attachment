module.exports = function(grunt) {
	const sass=require('node-sass');
	
	grunt.initConfig({
		pkg:grunt.file.readJSON('package.json'),
		
		cssmin:{
			target:{
				files:[{
					expand:true,
					cwd:'themes/test/css',
					src:['*.css','!*.min.css'],
					dest:'themes/test/css',
					ext:'.min.css'
				}]
			}
		},
		
		sass:{
			options:{
				implementation:sass,
				sourceMap:true,
			},
			
			dist:{
				files:[{
					expand:true,
					cwd:'themes/test/sass',
					src:['*.sass','*.scss','!_*.sass','!_*.scss'],
					dest:'themes/test/css',
					ext:'.css'
				}]
			}
		},
		
		watch:{
			css:{
				files:['**/*.sass','**/*.css?','^**/_*.sass'],
				tasks:['sass','cssmin']
			}
		}
	});
	
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-sass');
	grunt.loadNpmTasks('grunt-contrib-watch');
	
	grunt.registerTask('default',['watch']);
};