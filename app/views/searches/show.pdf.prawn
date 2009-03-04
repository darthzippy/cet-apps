pdf.font "Helvetica"

pdf.text "CET Apps Custom Search Report", :size => 24, :style => :bold

pdf.text "Control		Model		Department		User", :size => 16, :style => :bold, :spacing => 4
@search.computers.each do |computer|
  pdf.text "#{computer.control}			#{computer.model} 		#{computer.department.name unless computer.department.nil?}				#{computer.user.fullname unless computer.user.nil?}"
end

