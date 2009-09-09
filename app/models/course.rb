class Course < ActiveRecord::Base
  validates_uniqueness_of :source, :on => :create, :message => "must be unique"
  
  def self.search(search, page)
    paginate :per_page => 15, :page => page,
             :conditions => ['source like ?', "%#{search}%"],
             :order => 'source ASC'
  end
end
