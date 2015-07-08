# ThewbbFormBundle
阿里云OSS文件直接上传bundle，可以与sonata admin集成使用


安装方法：
下载项目，并将整个目录复制到src文件夹下。


设置路由：

由于使用了iframe方式上传文件，所以需要设置iframe内使用的页面的路由。

prefix可以随意设置



    thewbb_admin:
  
      resource: "@ThewbbAdminBundle/Resources/config/routing.yml"
      
      prefix:   /
    
    
引入模板：

在config中文件中，将本项目使用的相关模板引入到系统中。



    twig: 
    
      debug:            "%kernel.debug%"
      
      strict_variables: "%kernel.debug%"
      
      form:
      
            resources:
            
                # ...
                
                - 'ThewbbFormBundle:Form:fields.html.twig'
              
              
              
加入项目内核：

在AppKernel.php文件中加入：

    new Thewbb\FormBundle\ThewbbFormBundle(),

              
              
使用：

在form中添加字段即可

    ->add('images', 'multi_upload', array('label' => '店铺相册'))

注意：
images为text类型字段，图片会先上传到oss上，然后将所有文件的完整url整理成json数组，存储到text字段中。

<img src="https://github.com/thewbb/ThewbbFormBundle/blob/master/Thewbb/FormBundle/doc/capture.png" />
