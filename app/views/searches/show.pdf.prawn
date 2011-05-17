pdf.font "Helvetica"

pdf.text "CET Apps Custom Search Report", :size => 24, :style => :bold
pdf.text "Created at #{Time.now.to_formatted_s(:long)} by #{current_cet_user.display_name}"

pdf.move_down(10)

items = @search.computers.map do |item|
  [
    item.control,
	item.serial,
	item.model,
	item.departments.first.try(:name),
	item.user.try(:to_s),
	item.status,
	item.try(:replacement_year)
  ]
end

pdf.table items,
  :row_colors         => ["FFFFFF", "DDDDDD"],
  :headers            => ["Control", "Serial", "Model", "Department", "User", "Status", "Replacement Year"],
  :align_headers      => :left,
  :font_size          => 9,
  :border_width       => 0.2