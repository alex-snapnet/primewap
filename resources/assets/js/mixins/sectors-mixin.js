var SectorMixin = {
  
  methods:{
    fetchSectors(){
        fetch('api/sector')
        .then(res=>res.json())
        .then(res=>{
            this.sectors = res.data;
        });
      }

    }

};

exports.SectorMixin = SectorMixin;