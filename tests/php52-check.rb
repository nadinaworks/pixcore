path = ARGV[0]

# imediate output
$stdout.sync = $stderr.sync = true

$stdout.puts
$stdout.puts " PHP 5.2 syntax check"
$stdout.puts " ----------------------------------------------------"

def scan(path)
    errors = 0
    Dir.glob(path+'/*') do |file|
        next if file == '.' or file == '..'
        if File.directory? file
            errors += scan(file)
        else # not directory
            if file =~ /.*\.php$/
                msg = `php52 -l #{file}`
                if msg =~ /^No syntax errors.*/
#                    $stdout.puts "    valid #{file}"
                else # invalid
                    $stdout.puts "  invalid #{file}"
                    $stdout.puts msg.strip
                    $stdout.puts
                    errors += 1
                end
            end
        end
    end#glob
    return errors
end

$stdout.puts " finished checking files"
$stdout.puts " ----------------------------------------------------"
$stdout.puts

exit scan(path)
